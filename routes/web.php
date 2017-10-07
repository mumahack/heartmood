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
    return view('frontend');
});

Route::get('/backend', function () {
    return view('backend');
});


Route::get('/tcpcommand', function () {
    return json_encode(array("command" => "FSOC002255"));
});


Route::post('/setvalue', function () {
    $name = $_POST["name"];
    $value = $_POST["value"];
    $configStorage = \App\ConfigStorage::firstOrNew(['name' => $name]);
    $configStorage->value = $value;
    $configStorage->save();
});

Route::get('/getvalue', function () {

    $configstorage = App\ConfigStorage::all();
    $retArr  = [];
    foreach( $configstorage->toArray() as $item){
        $retArr[$item["name"]] = $item["value"];
    }
    return json_encode($retArr);
});
