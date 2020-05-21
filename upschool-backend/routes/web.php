<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Broadcast::routes([
//     'middleware' => 'api',
// ]);
Route::get('/', function () {
    return view('welcome');
    // dd(Carbon::parse('2020-05-20T03:15:00')->addCenturies(3));
});
