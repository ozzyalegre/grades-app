<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardDataService;

class DashboardDataController extends Controller
{
    public function show(){
        $dds = new DashboardDataService();
        return view('dashboard', [
            "terms" => $dds->terms,
            "subjects" => $dds->subjects,
            "currentTerm" => $dds->currentTerm,
            "subjectsGrades" => $dds->subjectsGrades,
            "subjectsGradesHistory" => $dds->subjectsGradesHistory
        ]);
    }
}
