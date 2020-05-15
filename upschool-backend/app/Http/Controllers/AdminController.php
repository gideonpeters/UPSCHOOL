<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        //
        $admins = Admin::with('user')->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the admins',
            'data' => $admins
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->save();

        $user = new User();
        $user->name = $admin->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->userable_id = $admin->id;
        $user->userable_type = 'App\Admin';
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'New Admin Account created',
            'data' => $admin->load('user')
        ], 201);
    }

    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy($admin_id)
    {
        //
        $admin = Admin::find($admin_id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'admin does not exist',
                'data' => []
            ], 201);
        }

        $admin->delete();

        return response()->json([
            'status' => true,
            'message' => 'admin deleted successfully',
            'data' => []
        ], 201);
    }
}
