<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParseService;
use App\Services\DataStorageService;

class WebhookController extends Controller
{
    public function processIncomingWebhook(Request $request){
        $body = $request->all();
        // dd($body);
        // $new_report = $this->parseAndStore($body);
        return response()->json(['message' => 'Report added successfully.', 'request' => dd($body), ], 201);
    }

    public function parseAndStore($message){
        // Parse New Message
        $parser = new ParseService;
        $parsed_class_grades = $parser->ParseHtml($message);
        $parsed_terms = $parser->GetTerm();

        // DataStorage Time!
        $ds = new DataStorageService;
        $ds->CreateTerms($parsed_terms);    // Create Terms if they do not exist
        $report = $ds->CreateReport($message);    // Create New Report entry
        $ds->CreateSubjectsAndGrades($parsed_class_grades, $report); // Adds grades to grades table & subjects if they do not exist

        return $report;
    }
}
