<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik/webhook', 'TelegramController@hook');

Route::get('/last', function () {
    $fp = fopen("emranfile.txt", "rb");
    fseek($fp, 0, SEEK_END);
    $size = ftell($fp);
    fclose($fp);

    $myfile = fopen("emranfile.txt", "r") or die("Unable to open file!");
    $last = fread($myfile, $size);
    fclose($myfile);

    dd($last);
});