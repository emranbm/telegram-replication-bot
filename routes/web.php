<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Telegram\Bot\Api;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setWebhook', function () {
    $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');
    $response = $telegram->setWebhook(['url' => 'https://nasim-trbot/249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik/webhook']);
    return $response;
});

Route::post('/249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik/webhook', function (Request $request) {
    error_log($request->all());
});