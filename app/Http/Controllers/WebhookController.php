<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParseService;
use App\Services\DataStorageService;
use Carbon\Carbon;
use stdClass;

class WebhookController extends Controller
{
    public function processIncomingWebhook(Request $request){
        $request = json_decode($request->getContent());
        $message = new stdClass;
        $message->mid = $request->mid;
        $message->date_received = new Carbon($request->date_received, 'America/New_York');
        $message->from = $request->from;
        $message->body = $request->body;
        try {
            $new_report = $this->parseAndStore($message);
            return response()->json(['message' => 'Report added successfully.', 'request' => $new_report->message_id], 201);
        } catch (\Throwable $th) {
            logger($th);
            return response()->json(['message' => 'Report failed to be added.', 'error' => $th], 201);
        }
    }

    public function parseAndStore($message){
        // Parse New Message
        $parser = new ParseService;
        $parsed_class_grades = $parser->ParseHtml($message->body);
        $parsed_terms = $parser->GetTerm();

        // DataStorage Time!
        $ds = new DataStorageService;
        $ds->CreateTerms($parsed_terms);    // Create Terms if they do not exist
        $report = $ds->CreateReport($message);    // Create New Report entry
        $ds->CreateSubjectsAndGrades($parsed_class_grades, $report); // Adds grades to grades table & subjects if they do not exist

        return $report;
    }
}
