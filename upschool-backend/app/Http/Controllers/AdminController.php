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

        return response()->json([
            'status' => true,
            'message' => 'New Admin Account created',
            'data' => $admin->load('user')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
