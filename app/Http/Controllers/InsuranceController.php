<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InsuranceController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('status', true)->where('branch_id', Auth::user()->branch_id)->get();

        $insurances = Insurance::whereHas('client', function ($q) {
            return $q->where('branch_id', Auth::user()->branch_id);
        })->where('status', true)->get();

        return view('insurance.index', ['insurances' => $insurances, 'clients' => $clients]);
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
        DB::beginTransaction();
        try {
            $insurance = new Insurance($request->all());
            $insurance->save();
            DB::commit();
            return redirect('insurance');
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500' . ['error' => $th]);
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
            $insurance = Insurance::findOrFail($id);
            $insurance->update($request->all());
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
            $insurance = Insurance::findOrFail($id);
            $insurance->changeStatus(false);
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500' . ['error' => $th]);
        }
    }
}
