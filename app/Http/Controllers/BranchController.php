<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends NotificationController
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
        return view('branch.index', ['branches' => $branches]);
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

            Branch::create($request->all());
            DB::commit();
            return redirect('branch')->with(['success' => "Sucursal registrada correctamente"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return view('errors.500', ['error' => $th]);
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
        $branch = Branch::findOrFail($id);
        DB::beginTransaction();
        try {
            $branch->edit($request->all());
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {

            DB::rollback();
            return back()->withErrors(["error" => "No se pudo realizar la operación. " . $th]);
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
        try {
            $branch = Branch::findOrFail($id);
            $branch->changeStatus(false);

            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            return back()->withErrors(["error" => "No se pudo realizar la operación. " . $th]);
        }
    }
}
