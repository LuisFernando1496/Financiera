<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends NotificationController
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
            $users = ModelsUser::where('id', '!=', Auth::user()->id)->get();
        } else {
            $branches = Branch::where('status', 1)->where('id', Auth::user()->branch_id)->get();
            $users = ModelsUser::where('branch_id', Auth::user()->branch_id)->where('id', '!=', Auth::user()->id)->get();
        }
        return view('users.index', ['users' => $users, 'branches' => $branches]);
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
            $user = new ModelsUser($request->all());
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole($request->rol);
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
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
        DB::beginTransaction();
        try {
            $user = ModelsUser::findOrFail($id);
            $user->update($request->all());
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
            $user = ModelsUser::findOrFail($id);
            $user->changeStatus(false);
            DB::commit();
            return back()->with(["success" => "Éxito al realizar la operación."]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return view('errors.500', ['errors' => $th]);
        }
    }
}
