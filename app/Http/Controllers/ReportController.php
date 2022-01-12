<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Credit;
use App\Models\Expense;
use App\Models\Insurance;
use App\Models\Payment;
use App\Models\Saving;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('branch_id', Auth::user()->branch_id)->get();
        return view('report.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    private function totalCreditsAccepted($request)
    {
        $creditsAccept = Credit::whereHas('client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', 1)
            ->whereBetween('created_at', [$request->start_date, $request->end_date])->get();


        $pdf = \PDF::loadView(
            'report.credits',
            ['start_date' => $request->start_date, 'end_date' => $request->end_date, 'credits' => $creditsAccept]
        );

        return $pdf->stream();
        // return dd($creditsAccept);
    }

    private function totalOfDay()
    {
        $payments = Payment::whereHas('credit.client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', false)->whereDate('created_at', Carbon::now())->get();

        $totalPayments = Payment::select(DB::raw('sum(efectivo) as total'))->where('status', false)
            ->whereDate('created_at', Carbon::now())
            ->whereHas('credit.client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->first()->total;

        $expenses = Expense::where('branch_id', Auth::user()->branch_id)->with('user')
            ->whereDate('created_at', Carbon::now())->get();

        $insurances = Insurance::whereHas('client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', true)->with('client')->whereDate('created_at', Carbon::now())->get();

        $totalInsurances = Insurance::select(DB::raw('sum(cost) as total'))->where('status', true)
            ->whereDate('created_at', Carbon::now())
            ->whereHas('client', function ($q) {
                return $q->where('branch_id', Auth::user()->branch_id);
            })->first()->total;

        $pdf = \PDF::loadView(
            'report.totalOfDAY',
            ['day' => Carbon::now()->format('d-M-Y'), 'payments' => $payments, 'total_payments' => $this->formatNumber($totalPayments), 'expenses' => $expenses, 'insurances' => $insurances, 'total_insurances' => $this->formatNumber($totalInsurances)]
        );

        return $pdf->stream();
    }

    private function goodClients($request)
    {
        $gooders = [];
        $credits = Credit::whereHas('client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', 1)
            ->whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        foreach ($credits as $key) {
            $payments = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))
                ->where('credit_id', $request->credit_id)->orderBy('id', 'DESC')->get();
            foreach ($payments as $value) {
                $last_payment = Payment::where('credit_id', $key->id)->orderBy('id', 'DESC')->first();
                if ($last_payment != null) {
                    $key->last_payment = $last_payment->fecha_limite;
                }
                if ($value->Days > "0") {
                    array_push($gooders, $key);
                }
            }
        }
        $pdf = \PDF::loadView(
            'report.goodClient',
            ['data' => $gooders, 'start_date' => $request->start_date, 'end_date' => $request->end_date]
        );

        return $pdf->stream();
    }

    private function badClients($request)
    {
        $badders = [];
        $credits = Credit::whereHas('client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', 1)
            ->whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        foreach ($credits as $key) {
            $payments = Payment::select('id', 'credit_id', 'status', 'fecha', 'fecha_limite', DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))
                ->where('credit_id', $request->credit_id)->orderBy('id', 'DESC')->get();
            foreach ($payments as $value) {
                $last_payment = Payment::where('credit_id', $key->id)->orderBy('id', 'DESC')->first();
                if ($last_payment != null) {
                    $key->last_payment = $last_payment->fecha_limite;
                }
                if ($value->Days < "0") {
                    $key->stats = "Atrasado " + ($value->Days);
                    array_push($badders, $key);
                }
            }
        }
        $pdf = \PDF::loadView(
            'report.badClient',
            ['data' => $badders, 'start_date' => $request->start_date, 'end_date' => $request->end_date]
        );

        return $pdf->stream();
    }

    private function formatNumber($total)
    {
        if ($total != null || $total != 0) {
            return number_format($total, 4);
        } else {
            return number_format(0, 2);
        }
    }

    public function record($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data = Credit::join("payments", "payments.credit_id", "=", "credits.id")
            ->join("clients", "clients.id", "=", "credits.client_id")
            ->select(DB::raw(
                'clients.name as name,
                    clients.last_name as lastname,
                    credits.num_credit as creditNum,
                    credits.total_credit as totalCredit,
                    credits.time_credit as creditTime,
                    payments.concepto as creditType,
                    payments.fecha_limite as finalDate,
                    payments.efectivo as cash,
                    payments.moratorios as moratorios,
                    payments.resta as restCredit
                    '
            ))
            ->where("payments.tipo", "!=", "0")
            ->orderBy("payments.credit_id")
            ->get();

        // dd($data);

        $pdf = \PDF::loadView('report.record', ['data' => $data, 'report_type' => $request->report_type, 'start_date' => $start_date, 'end_date' => $end_date]);
        return $pdf->stream();

        // dd("aqui", $start_date, $end_date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        switch ($request->report_type) {
            case 'Corrientes':
                return $this->goodClients($request);
                break;
            case 'Atrasados':
                return $this->badClients($request);
                break;
            case 'Cuenta':
                return $this->record($request);
                break;
            case 'Creditos':
                return $this->totalCreditsAccepted($request);
                break;
            default:
                return $this->totalOfDay();
                break;
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
