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

Route::get('/getWebhook', function(){
    $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');
    dd($telegram->getWebhookInfo([0]));
});

Route::get('/setWebhook', function () {
    $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');
    $response = $telegram->setWebhook(['url' => 'https://nasim-trbot.elenoon.ir/api/AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik/webhook']);
    return $response;
});

Route::get('/get',function(){
    $myfile = fopen("emranfile.txt", "w") or die("Unable to open file!");
    fread($myfile, 20);//filesize("emranfile.txt"));
    fclose($myfile);
});