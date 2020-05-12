<?php

namespace App\Http\Controllers;

use App\File;
use App\Exeat;
use App\ExeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExeatController extends Controller
{
    public function index()
    {
        //
        $exeats = Exeat::all();

        return response()->json([
            'status' => true,
            'message' => 'These are all the exeats',
            'data' => $exeats
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $exeat_type = ExeatType::find($request->exeat_type_id);

        if (!$exeat_type) {
            return response()->json([
                'status' => false,
                'message' => 'Exeat type does not exist',
                'data' => []
            ], 201);
        }
        $table->string('status')->default('pending');
        $table->longText('reason');
        $table->dateTime('requested_departure');
        $table->dateTime('actual_departure')->nullable();
        $table->dateTime('expected_arrival');
        $table->dateTime('actual_arrival')->nullable();

        $exeat = new Exeat();
        $exeat->exeat_type_id = $exeat_type->id;
        $exeat->exeat_id = "EXT";
        $exeat->reason = $request->reason;
        $exeat->requested_departure = $request->requested_departure;
        $exeat->expected_arrival = $request->expected_arrival;
        $exeat->save();

        if ($request->hasFile('file')) {
            $path = Storage::putFileAs(
                "documents/exeat-applications/$exeat_type->name",
                $request->file('file'),
                preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $exeat->exeat_id)) . '.' . $request->file('file')->getClientOriginalExtension()
            );

            $file = new File();
            $file->name = $request->file('file')->getClientOriginalName();
            $file->type = $request->file('file')->getClientMimeType();
            $file->path = $path;
            $file->fileable_id = $exeat->id;
            $file->fileable_type = 'App\Exeat';

            $file->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'submitted successfully',
            'data' => $exeat
        ], 201);
    }

    public function show(Exeat $exeat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exeat  $exeat
     * @return \Illuminate\Http\Response
     */
    public function edit(Exeat $exeat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exeat  $exeat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exeat $exeat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exeat  $exeat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exeat $exeat)
    {
        //
    }
}
