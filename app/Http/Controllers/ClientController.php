<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Credit;
use App\Models\VisitModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->giveRole() == 'supManager') {
            $clients = Client::with(['insurance', 'accepted_credits.payments', 'rejected_credits'])
                ->where('status', true)->get();

            $branches = Branch::where('status', true)->get();
        } else {
            $clients = Client::with(['insurance', 'accepted_credits.payments', 'rejected_credits'])
                ->where('status', true)->where('branch_id', Auth::user()->branch_id)->get();

            $branches = Branch::where('status', true)->where('id', Auth::user()->branch_id)->get();
        }

        return view('client.index', ['clients' => $clients, 'branches' => $branches]);
    }
    public function showClients($branchID)
    {

        $clients = Client::where('branch_id', $branchID)
            ->where('status', true)->get();

        return response()->json($clients);
    }
    public function showCredits($creditID)
    {

        $credits = Credit::where('client_id', $creditID)
            ->where('status', true)->get();

        return response()->json($credits);
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
        $this->validate(
            $request,
            [
                'phone' => 'required|integer',
                'rfc' => 'required|unique:clients',
                'curp' => 'required|unique:clients',
                'email' => 'required|unique:clients'
            ],
            [
                'phone.integer' => 'El teléfono debe contener solo dígitos',
                'rfc.unique' => 'Este RFC ya se encuentra registrado',
                'email.unique' => 'El correo ya se encuentra registrado',
                'curp.unique' => 'La CURP ya se encuentra registrada'
            ]
        );
        DB::beginTransaction();
        try {
            $client = new Client($request->all());
            $client->user_id = Auth::user()->id; //Aca debe ir el usuario loggeado
            if ($request->hasFile('clientImg')) {
                $file = $request->clientImg;
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('public', $fileName);
                $client->imgClient = $fileName;
            }
            $client->visit_status = "0";
            $client->save();
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors(["error" => "Falló la operación, verifique los datos"]);
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
            $client = Client::findOrFail($id);
            if ($request->hasFile('clientImgEdit')) {
                $file = $request->clientImgEdit;
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('public', $fileName);

                $client->name = $request->name;
                $client->last_name = $request->last_name;
                $client->email = $request->email;
                $client->rfc = $request->rfc;
                $client->curp = $request->curp;
                $client->phone = $request->phone;
                $client->cellphone = $request->cellphone;
                $client->genre = $request->genre;
                $client->street = $request->street;
                $client->int_number = $request->int_number;
                $client->ext_number = $request->ext_number;
                $client->suburb = $request->suburb;
                $client->postal_code = $request->postal_code;
                $client->city = $request->city;
                $client->state = $request->state;
                $client->country = $request->country;
                $client->imgClient = $fileName;
            } else {
                $client->update($request->all());
            }
            $client->save();
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
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
            $client = Client::findOrFail($id);
            $client->changeStatus(false);
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }

    public function routeDay()
    {
        $todayD = Carbon::now()->format('d');
        $todayM = Carbon::now()->format('m');
        $credits = Client::join("credits", "credits.client_id", "=", "clients.id")
            ->leftjoin("payments", "payments.credit_id", "=", "credits.client_id")
            ->select(DB::raw(
                "clients.id as client_id,
                        clients.name as clientName,
                        clients.last_name as clientLastName,
                        clients.phone as clientPhone,
                        clients.suburb as address1,
                        clients.street as addressStreet,
                        clients.int_number as addressNum,
                        clients.city  as clientCity,
                        clients.state as clientState,
                        clients.country as clientCountry,
                        clients.status_credit as statusCredit,
                        clients.visit_status as visitStatus,
                        concepto as creditType,
                        time_Credit as creditTime,
                        last_name_aval as avalName,
                        second_last_name_aval as avalLastname1,
                        name_aval as avalLastName2,
                        phone_aval as avalPhone,
                        fecha_limite as dateLimit,
                        monto as totalCredit,
                        payments.fecha as lastPaymentDate,
                        payments.resta as creditRest"
            ))
            ->orderByDesc('payments.id')
            ->distinct()
            ->simplePaginate(2);

        return view('client.routeDay', [
            'creditsTotal' => $credits
        ]);
    }

    public function visitInProcess($id)
    {
        // usar un find or fail y checar si ya existe algun registro y si no se creo
        // si si existe se actualiza
        $today = Carbon::now();
        $visit = new VisitModel();
        $visit->id_client = $id;
        $visit->status = "1";
        $visit->fecha = $today->format('Y-m-d');
        $visit->descripcion = "En proceso";
        $visit->save();


        DB::table('clients')->where([['id', '=', $id],])->update([
            'visit_status' => '1'
        ]);

        return response()->json(['data' => $visit]);
    }

    public function visits()
    {
        $clients = Client::join("visits", "visits.id_client", "=", "clients.id")
            ->select(DB::raw(
                "visits.id as visitaId,
                    name as nombre,
                    last_name as apellido,
                    email as email,
                    phone as phone,
                    cellphone as cellphone,
                    fecha as fecha,
                    descripcion as descripcion,
                    visits.status as visitStatus"
            ))
            ->get();
        return view('client.visits', [
            'clients' => $clients
        ]);
    }

    public function visitDone($id)
    {
        $today = Carbon::now();
        $visit = VisitModel::where('id', $id)->get();
        DB::table('clients')->where([['id', '=', $visit[0]->id_client],])->update([
            'visit_status' => '2'
        ]);

        DB::table('visits')->where([['id', '=', $id],])->update([
            'status' => '2',
            'fecha' => $today->format('Y-m-d'),
            'descripcion' => "Visitado"

        ]);

        return response()->json(['data' => $visit]);
    }

    public function visitsStatus($data)
    {
        $today = Carbon::now();
        $info = explode(",", $data);
        if (count($info) <= 2) {
            $clients = Client::join("visits", "visits.id_client", "=", "clients.id")
                ->select(DB::raw(
                    "visits.id as visitaId,
            name as nombre,
            last_name as apellido,
            email as email,
            phone as phone,
            cellphone as cellphone,
            fecha as fecha,
            descripcion as descripcion,
            visits.status as visitStatus"
                ))
                ->where("visits.status", "=", $info[1])
                ->where("visits.fecha", "=", $today->format('Y-m-d'))
                // ->simplePaginate(2);
                ->get();
        } else {
            $info[0];
            $from = $info[0];
            $to = $info[1];
            $clients = Client::join("visits", "visits.id_client", "=", "clients.id")
                ->select(DB::raw(
                    "visits.id as visitaId,
            name as nombre,
            last_name as apellido,
            email as email,
            phone as phone,
            cellphone as cellphone,
            fecha as fecha,
            descripcion as descripcion,
            visits.status as visitStatus"
                ))
                ->where("visits.status", "=", $info[2])
                ->whereIn('visits.fecha', [$from, $to])
                // ->simplePaginate(2);
                ->get();
        }
        return response()->json(['info' => $clients]);
    }
}
