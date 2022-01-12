<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Payment;
use Carbon\Carbon;

use DateTime;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->giveRole() == 'supManager') {
            $branches = Branch::where('status', 1)->get();
        } else {
            $branches = Branch::where('status', 1)->where('id', Auth::user()->branch_id)->get();
        }
        return view('payment.index', ["branches" => $branches]);
    }
    public function showPayments(Request $request)
    {

        if ($request->client_id != null) {
            $credit = Credit::findOrFail($request->credit_id);
            $payments = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))->where('credit_id', $request->credit_id)->orderBy('id', 'DESC')->get();
            $last_payment = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', 'monto', 'resta', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))->where('credit_id', $request->credit_id)->orderBy('id', 'DESC')->first();

            return view('payment.data', ["payments" => $payments, "last_payment" => $last_payment, "credit" => $credit, "bool" => true]);
        } else {
            $payments = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))->get();

            return view('payment.data', ["payments" => $payments, "bool" => false]);
        }
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

        $credit = Credit::findOrFail($request->credit_id);
        $request["folio"] = $this->checkFolio($request->credit_id);

        $today = Carbon::now();
        $request["fecha"] = $today->format('Y-m-d');
        $request["concepto"] = $this->setConcept($credit);
        $request["fecha_limite"] = $this->generateLimitDate($request->next_payment);

        DB::beginTransaction();
        try {

            $last_payment_done = Payment::create($request->all());

            $pagos = Payment::where('credit_id', $request->credit_id)->where('id', '!=', $last_payment_done->id)->get();

            if ($pagos != "[]") {
                $pagos->toQuery()->update(['status' => true]);
            }


            DB::commit();
            return view('payment.ticket', ['payment' => $last_payment_done]);
            return redirect("/payment")->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect("/payment")->withErrors(["error" => $th]);
        }
    }

    private function checkFolio($idFolio)
    {
        $folio = Payment::where('credit_id', $idFolio)->max('folio');

        if ($folio == null) {
            $folio = 1;
        } else {
            $folio = $folio + 1;
        }
        return $folio;
    }

    private function setConcept($credit)
    {
        $concept = "";
        if ($credit->individual_credit != null) {
            $concept = "pago crédito individual";
        } else if ($credit->seller_credit != null) {
            $concept = "pago crédito comerciante";
        } else if ($credit->aditional_credit != null) {
            $concept = "pago crédito adicional paralelo";
        } else if ($credit->renovation_credit != null) {
            $concept = "pago renovación";
        } else if ($credit->insurance_credit != null) {
            $concept = "pago seguro de vida";
        } else {
            $concept = "pago de garantia";
        }
        return $concept;
    }

    private function generateLimitDate($next_payment)
    {
        $limitDate = null;
        if ($next_payment == null) {

            $fecha_limite = Carbon::now()->addDays(7);
            if ($fecha_limite->dayOfWeek == 0) {
                $fecha_limite->addDays(1);
            }
            $limitDate = $fecha_limite->format('Y-m-d');
        } else {

            $fecha_limite = Carbon::parse($next_payment);

            if ($fecha_limite->dayOfWeek == 0) {
                $fecha_limite->addDays(1);
            }
            $limitDate = $fecha_limite->format('Y-m-d');
        }
        return $limitDate;
    }

    public function searchPayments($id)
    {
        return view('payment.data');
    }

    public function reprint(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->first();
        return view('payment.ticket', ['payment' => $payment]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
