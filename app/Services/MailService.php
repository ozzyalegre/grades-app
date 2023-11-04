<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;

class MailService
{
    public function GetMail($date){
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('Inbox');
        $my_date = new Carbon($date, 'America/New_York');
        $messages = $folder->messages()->since($my_date)->get();
        
        $new_message = null;
        foreach ($messages as $key => $m) { 
            $entry = (object) [
                'date_received' => $m->date,
                'subject' => $m->subject,
                'mid' => $m->message_id,
                'from' => $m->from,
                'body' => $m->getHTMLBody(),
            ];
            $new_message = $entry;
        }

        return $new_message;
    }
}
