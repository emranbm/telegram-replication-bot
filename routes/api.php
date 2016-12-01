<?php

use Illuminate\Http\Request;
use Telegram\Bot\Api;

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

Route::post('/AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik/webhook', function () {

    $update = Telegram::commandsHandler(true);

    $myfile = fopen("emranfile.txt", "w") or die("Unable to open file!");
    $txt = $update;
    fwrite($myfile, $txt);
    fclose($myfile);

    $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');

    $telegram->sendMessage([
        'chat_id' => $update->get('message')->get('chat')->get('id'),
        'text' => 'سلام. من زندم. ولی نه اونقدری که جوابتو بدم!'
    ]);

    return 'ok';
});

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