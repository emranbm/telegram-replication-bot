<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    //

    public function hook()
    {
        $update = Telegram::commandsHandler(true);

        $myfile = fopen("emranfile.txt", "w") or die("Unable to open file!");
        $txt = $update;
        fwrite($myfile, $txt);
        fclose($myfile);

        $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');

        if ($update->get('channel_post') != null)
            $this->transferMessage($update->get('channel_post')/*->get('chat')->get('id')*/);
        else
            $telegram->sendMessage([
                'chat_id' => $update->get('message')->get('chat')->get('id'),
                'text' => 'سلام. من زندم! ولی نه اونقدری که جوابتو بدم!'
            ]);

        return 'ok';
    }

    private function transferMessage($message)
    {
        $myfile = fopen("emranfile2.txt", "w") or die("Unable to open file!");
        $txt = $message;
        fwrite($myfile, $txt);
        fclose($myfile);

    }
}