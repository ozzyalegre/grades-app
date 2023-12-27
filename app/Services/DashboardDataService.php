<?php
namespace App\Services;

use App\Models\Term;
use App\Models\Report;
use App\Models\Grade;
use App\Models\Subject;
use stdClass;

class DashboardDataService
{
    // General useful lists
    public $subjects;        
    public $terms;       
    public $currentTerm;   

    // For Grades Table
    public $lastReportGrades;
    public $subjectsGrades;

    // Array For Subject Grades over time Charts
    public $subjectsGradesHistory;

    public function __construct() {
        $this->lastReportGrades = Report::lastReportGrades();
        $this->subjects = $this->lastReportGrades->pluck('subject')->unique('id');
        $this->terms = $this->lastReportGrades->pluck('term')->unique('id');
        $this->currentTerm = $this->terms->last();
        $this->subjectsGrades = $this->subjectsAndGrades(); 
        
        // Add entries to $subjectsGradesHistory
        $tempArray = [];
        foreach ($this->subjects as $s) {
            $entry = new stdClass;
            $entry->name = $s->name;
            $entry->id = $s->id;
            $entry->chart = $this->getSubjectGradeHistory($this->currentTerm->id, $s->id, 10);
            
            array_push($tempArray, $entry);
        }
        $this->subjectsGradesHistory = $tempArray;
        // dd($this->subjectsGradesHistory);
    }

    public function subjectsAndGrades(){
        $subjectsGrades = [];
    
        foreach ($this->subjects as $key => $subject) {
            $entry = new stdClass;
            $entry->name = $subject->name;
            $entry->grades = [];

            foreach ($this->terms as $key => $term) {
                // magic
                $g = $this->lastReportGrades->where(function ($g) use ($subject, $term) {
                    return $g->subject->id === $subject->id && $g->term->id === $term->id;
                })->first();

                array_push($entry->grades, $g);
            }
            array_push($subjectsGrades, $entry);
        }
        return $subjectsGrades;
    }

    public function getSubjectGradeHistory($term_id, $subject_id, $take_num){
        $subject_grades_gpas = Grade::findPastGrades($term_id, $subject_id, 'gpa', $take_num)->toArray();
        $temp_dates = Grade::findPastGrades($term_id, $subject_id, 'updated_at', $take_num);

        $subject_grades_dates = collect($temp_dates)->map(function ($date){
            return $date->format('m/d');
        })->toArray();
        
        $subject_grades_gpas = array_reverse($subject_grades_gpas);
        $subject_grades_dates = array_reverse($subject_grades_dates);

        $entry = new stdClass;
        $entry->dates = $subject_grades_dates;
        $entry->gpas = $subject_grades_gpas;

        return $entry;
    }

}

