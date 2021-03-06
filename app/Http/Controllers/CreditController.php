<?php

namespace App\Http\Controllers;

use App\Models\CashClosing;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Documents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;
use App\Models\User as ModelsUser;

class CreditController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->giveRole() == 'supManager') {
            $credits = Credit::whereHas('client')->where('status', 1)->orWhere('status', null)->get();
            $clients = Client::where('status', true)->get();
        } else {
            $credits = Credit::whereHas('client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->where('status', 1)->orWhere('status', null)->get();
            $clients = Client::where('status', true)->where('branch_id', Auth::user()->branch_id)->get();
        }

        return view('credit.index', ['credits' => $credits, 'clients' => $clients, 'documents' => Documents::get()]);
    }
    public function showCancelledCredits()
    {
        $credits = Credit::with(['client'])->where('status', 0)->get();
        return view('credit.cancelled', ['credits' => $credits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return back()->with(["success" => "STORE"]);
        $json_clientId = json_decode($request->client_id, true);
        $request['client_id'] = $json_clientId['id'];
        //return response()->json($request->all());
        DB::beginTransaction();
        try {
            $credit = Credit::create($request->all());
            
            if ($request->hasFile('fileLocal')) {
                $file = $request->fileLocal;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public', $fileName);
                $credit->fileName = $fileName;
                $credit->url = $filePath;
            }
            $credit->save();
            DB::commit();
            return back()->with(["success" => "??xito al realizar la operaci??n."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }

    public function numCredit(Request $request, $id){
        return response()->json("editar numero de credito");
    }

    public function documentationCreditUp(Request $request){
        //return response()->json($request->credit_id);
        if($request->hasFile("document_1") and $request->hasFile("document_2") and $request->hasFile("document_3") and $request->hasFile("document_4")){
            DB::beginTransaction();
            $file1 = $request->file("document_1");
            $file2 = $request->file("document_2");
            $file3 = $request->file("document_3");
            $file4 = $request->file("document_4");
            if($file1->guessExtension() == 'pdf' and $file2->guessExtension() == 'pdf' and $file3->guessExtension() == 'pdf' and $file4->guessExtension() == 'pdf'){
                $nombre1 = $file1->getClientOriginalName();//"pdf_".time().".".$file->guessExtension();
                $ruta1 = $request->file('document_1')->store('public');//$file1->storeAs('public', $nombre1);//public_path("pdf/".$nombre); 
                $nombre2 = $file2->getClientOriginalName();//"pdf_".time().".".$file2->guessExtension();
                $ruta2 = $request->file('document_2')->store('public');//$file2->storeAs('public', $nombre2);//public_path("pdf/".$nombre2); 
                $nombre3 = $file3->getClientOriginalName();//"pdf_".time().".".$file3->guessExtension();
                $ruta3 = $request->file('document_3')->store('public');//$file3->storeAs('public', $nombre3);//public_path("pdf/".$nombre3); 
                $nombre4 = $file4->getClientOriginalName();//"pdf_".time().".".$file4->guessExtension();
                $ruta4 = $request->file('document_4')->store('public');//$file4->storeAs('public', $nombre4);//public_path("pdf/".$nombre4);
                $documentation = [
                    'credit_id' => $request->credit_id,
                    'document_1' => $nombre1,
                    'file_1' => $ruta1,
                    'document_2' => $nombre2,
                    'file_2' => $ruta2,
                    'document_3' => $nombre3,
                    'file_3' => $ruta3,
                    'document_4' => $nombre4,
                    'file_4' => $ruta4,
                ];
                $documents = new Documents($documentation);
                $documents->save();
                DB::commit();
                return back()->with(["success" => "Operaci??n exitosa, archivos guardados."]);
            }else{
                DB::rollBack();
                return back()->withErrors(["error" => "Solo se aceptar archivos con extensi??n PDF."]);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $credit = Credit::findOrFail($id);
            $credit->update($request->all());
            $credit->save();
            DB::commit();
            return back()->with(["success" => "??xito al realizar la operaci??n."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }

    public function acceptedCredit($id)
    {
        //return back()->with(["success" => "ACEPTCREDIT"]);
        DB::beginTransaction();
        try {
            $credit = Credit::findOrFail($id);
            $newExpense = [
                'quantity' => 1,
                'description' => 'Cr??dito',
                'price' => $credit->check_credit,
                'user_id' => Auth::user()->id,
                'branch_id' => Auth::user()->branch_id,
            ];
            $expense = new Expense($newExpense);
            $credit->status = true;
            $credit->payment_status = false;
            $credit->save();
            $expense->save();

            //se debe crear aqui un nuevo registro en la tabla payment
            $initialPayment = new Payment();
            if ($credit->individual_credit != null) {
                $initialPayment->concepto = "pago cr??dito individual";
            } else if ($credit->seller_credit != null) {
                $initialPayment->concepto = "pago cr??dito comerciante";
            } else if ($credit->aditional_credit != null) {
                $initialPayment->concepto = "pago cr??dito adicional paralelo";
            } else if ($credit->renovation_credit != null) {
                $initialPayment->concepto = "pago renovaci??n";
            } else if ($credit->insurance_credit != null) {
                $initialPayment->concepto = "pago seguro de vida";
            } else {
                $credit->concepto = "pago de garantia";
            }
            $initialPayment->tipo = "0";
            $today = Carbon::now();
            $initialPayment->fecha = $today->format('Y-m-d');
            $initialPayment->fecha_limite = $today->addDays(7);
            $initialPayment->monto = $credit->total_credit;
            $initialPayment->cambio = "0";
            $initialPayment->efectivo = "0";
            $initialPayment->resta = $credit->total_credit;
            $initialPayment->status = "0";
            $initialPayment->folio = "1";
            $initialPayment->moratorios = "0";
            $initialPayment->credit_id = $credit->id;
            $initialPayment->save();
            DB::commit();
            return $this->generateDocs($credit);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }

    public function generateDocs($credit)
    {
        $cycle = 0;
        $client = Client::findOrFail($credit->client_id);
        $credits = Credit::where('payment_status', true)->where('client_id', $credit->client_id)->get();
        if (count($credits) < 0) {
            $cycle = 1;
        } else {
            $cycle = count($credits);
        }
        $today = date("d-m-Y");
        Carbon::setLocale('es');
        $date = Carbon::now();
        $day = Carbon::parse($date)->day;
        $month = Carbon::parse($date)->monthName;
        $year = Carbon::parse($date)->year;

        //Data amortizationTable
        $fortnight = $credit->time_Credit * 4;

        //PDF
        $amortizationPDF =  \PDF::loadView('credit.amortizationTable', [
            'data' => $this->toHotFix($credit, $today, $fortnight), 'client' => $client, 'day' => $day, 'month' => $month, 'year' => $year, 'total_credit' => $this->formatNumber($credit->total_credit), 'credit' => $credit, 'amortization_num' => $fortnight
        ]);

        // clause
        $clause = \PDF::loadView('credit.collectionClause', [
            'client' => $client, 'numID' => $credit->num_id, 'check_credit' => $this->formatNumber($credit->check_credit), 'amortization_num' => $fortnight, 'rent' => $this->toHotFix($credit, $today, $fortnight)[1]['rent'],
            'day' => $day, 'month' => $month, 'year' => $year,
        ]);

        // promissory
        $promissory = \PDF::loadView('credit.promissoryNote', [
            'client' => $client, 'day' => $day, 'month' => $month, 'year' => $year, 'check_credit' => $this->formatNumber($credit->check_credit), 'credit' => $credit
        ]);

        $deposite = \PDF::loadView('credit.deposit', [
            'client' => $client, 'amountPay' => $this->toHotFix($credit, $today, $fortnight)[1]['rent']
        ]);
        $credit->amountPay = $this->toHotFix($credit, $today, $fortnight)[1]["rent"];
        $credit->save();
        // create folder by credit & client
        $folderName = 'credit_' . $credit->num_credit . '_client_' . $credit->client_id;
        Storage::makeDirectory('public/' . $folderName);
        $fileName1 = $folderName . '/' . 'Amortizaci??n.pdf';
        $fileName2 = $folderName . '/' . 'Contrato.pdf';
        $fileName3 = $folderName . '/' . 'Pagar??.pdf';
        $fileName4 = $folderName . '/' . 'Ficha_dep??sito.pdf';

        Storage::disk('public')->put($fileName1, $amortizationPDF->output());
        Storage::disk('public')->put($fileName2, $clause->output());
        Storage::disk('public')->put($fileName3, $promissory->output());
        Storage::disk('public')->put($fileName4, $deposite->output());

        //create zip and save files to download
        $zip = new ZipArchive;
        $name = $folderName . '.zip';
        if ($zip->open(public_path($name), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $files = File::files(public_path('storage/' . $folderName));

            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }
        return response()->download($name);
    }

    private function formatNumber($total)
    {
        if ($total != null || $total != 0) {
            return number_format($total, 2);
        } else {
            return number_format(0, 2);
        }
    }

    private function toHotFix($credit, $today, $fortnight)
    {
        $pays = [];
        $paysAmount = $this->formatNumber($credit->total_credit / $fortnight);

        for ($i = 1; $i < $fortnight + 1; $i++) {
            if ($i == 1) {
                $date = date("d-M-Y", strtotime("$today +1 week"));
                $pays[$i] = [
                    'num' => $i,
                    'date' => $this->createFormatDate($date),
                    'rent' => $paysAmount,
                ];
            } else {
                $date = date('d-M-Y', strtotime('+1 week', strtotime($pays[$i - 1]['date'])));
                $pays[$i] = [
                    'num' => $i,
                    'date' => $this->createFormatDate($date),
                    'rent' => $paysAmount,
                ];
            }
        }

        return $pays;
    }

    private function createFormatDate($date)
    {
        return Carbon::parse($date)->format('d-M-Y');
    }

    public function test()
    {
        $pdf = \PDF::loadView(
            'credit.deposit',
        );

        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $credit = Credit::findOrFail($id);
            $credit->changeStatus(false);
            DB::commit();
            return back()->with(["success" => "??xito al realizar la operaci??n."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }
}
