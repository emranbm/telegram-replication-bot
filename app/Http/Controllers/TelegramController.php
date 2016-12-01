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

        $myfile = fopen("logfile.txt", "a+") or die("Unable to open file!");
        $txt = '$update' . '<br/>';
        fwrite($myfile, $txt);
        fclose($myfile);

        $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');

        if ($update->get('channel_post') != null)
            $this->handleChannelMessage($update->get('channel_post')/*->get('chat')->get('id')*/);
        else
            $telegram->sendMessage([
                'chat_id' => $update->get('message')->get('chat')->get('id'),
                'text' => 'ﺱﻼﻣ. ﻢﻧ ﺰﻧﺪﻣ! ﻮﻟی ﻦﻫ ﺍﻮﻨﻗﺩﺭی کﻩ ﺝﻭﺎﺒﺗﻭ ﺏﺪﻣ!'
            ]);

        return 'ok';
    }

    private function handleChannelMessage($message)
    {
        $telegram = new Api('249465277:AAHEzjRDK66dcpRBCodjnDxj8MbsWzl6Cik');
        $channel = $message->get('chat')->get('username');

        if ($message->get("text") != null) {
            // so it's a text message
            $this->postRequest($this->getChannelKey($channel), $message->get('text'));
        } else if ($message->get('photo') != null) {
            // it's a photo message
            $photos = $message->get('photo');
            $hqPhoto = ($photos->getMessage());

            $myfile = fopen("logfile.txt", "a+") or die("Unable to open file!");
            $txt = 'salam: ' . $hqPhoto . '<br />';
            fwrite($myfile, $txt);
            fclose($myfile);
            return;

            $resp = $telegram->getFile([
                'file_id' => $hqPhoto->get('file_id')
            ]);
        }

    }

    private function postRequest($dest, $text, $mediaAddress = "", $mediaType = "")
    {
        $url = 'http://localhost:3000';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"destination":"' . $dest . '", "message":"' . $text . '", "mediaAddress":"' . $mediaAddress . '", "thumb":"", "media_type":"' . $mediaType . '"}');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    private function getChannelKey($channel)
    {
        //TODO
        return 'varzesh3';
    }
}