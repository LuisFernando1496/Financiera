<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashClosing;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends NotificationController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenses.index', ["expenses" => Expense::where('branch_id', Auth::user()->branch_id)->get()]);
        return view('expenses.data');
    }
    public function newExpense()
    {
        return view('expenses.data');
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
            foreach ($request->all() as $key => $item) {
                Expense::create([
                    'quantity' => $item['Cantidad'],
                    'description' => $item['Descripcion'],
                    'price' => $item['Precio/pza'],
                    'user_id' => Auth::user()->id,
                    'branch_id' => Auth::user()->branch_id,
                ]);
            }
            DB::commit();
            return response()->json('ok');
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
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
