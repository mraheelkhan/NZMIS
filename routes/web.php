<?php

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

Route::get('/', function () {
    //return view('welcome');
    $query = DB::select("Select * from CITIES");
    dd($query);
    try {
        DB::connection()->getPdo();
        echo "success";
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('/db', function(){
    try {
        DB::connection()->getPdo();
        echo "success";
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('/test', function(){
    echo "Pakistan";
});


Route::get('dashboard', 'DashboardController@index');
Route::get('dashboard/copc', 'DashboardController@copc');