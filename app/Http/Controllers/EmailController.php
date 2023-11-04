<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;

class EmailController extends Controller
{
    public function get_mail($date){
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('Inbox');
        $my_date = new Carbon($date, 'America/New_York');
        $messages = $folder->messages()->since($my_date)->get();
        
        foreach ($messages as $key => $m) { 
            $entry = [
                'date_received' => $m->date,
                'subject' => $m->subject,
                'mid' => $m->message_id,
                'from' => $m->from,
                'body' => $m->getHTMLBody(),
            ];
            
            dd($entry);
        }

        return dd($messages);
    }
}
