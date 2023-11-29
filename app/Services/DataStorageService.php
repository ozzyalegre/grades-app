<?php
namespace App\Services;


use App\Models\Term;
use App\Models\Report;
use App\Models\Grade;
use App\Models\Subject;



class DataStorageService
{
    public function CreateTerms($parsed_terms){
        if(Term::count() === 0){
            foreach ($parsed_terms as $t) {
                $term = Term::firstOrCreate([
                    'name' => $t
                ]);
            }
            return True;
        } 
        else {
            return False;
        }
    }

    public function CreateReport($message){
        $report = Report::create([
            'message_id' => $message->mid,
            'date_received' => $message->date_received,
            'from' => $message->from,
            'html_body' => $message->body,
        ]);

        return $report;
    }

    public function CreateSubjectsAndGrades($subjects, $report){
        foreach ($subjects as $s) {     // Create Subjects if they don't exist
            $subject = Subject::firstOrCreate([
                'name' => $s->name,
                'period' => $s->period
            ]);
            
            $subject_grades = $s->grades;   // Selects grades array from subject item
            foreach ($subject_grades as $g) {
                $termOfGrade = Term::where('name', $g->semester)->first(); // Get grade term
                $grade = new Grade();
                $grade->letter = $g->letter;
                $grade->gpa = $g->gpa;
                $grade->subject()->associate($subject);
                $grade->report()->associate($report);
                $grade->term()->associate($termOfGrade);
                $grade->save();
            }
        }
    }


}

