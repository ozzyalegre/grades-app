<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grade;

class ClassGradeHistory extends Component
{   
    public $class_grades_gpas;
    public $class_grades_dates;
    public $term_id, $subject_id;
    public $class_name;

    public function mount($term_id, $subject_id){
        $this->class_grades_gpas = Grade::findPastGrades($term_id, $subject_id, 'gpa')->toArray();
        $temp_dates = Grade::findPastGrades($term_id, $subject_id, 'updated_at');

        $this->class_grades_dates = collect($temp_dates)->map(function ($date){
            return $date->format('m/d');
        })->toArray();
        
        $this->class_grades_gpas = array_reverse($this->class_grades_gpas);
        $this->class_grades_dates = array_reverse($this->class_grades_dates);
        
        // dd($this->class_grades_gpas, $this->class_grades_dates);
        
    }

    public function render()
    {
        return view('livewire.class-grade-history');
    }
}
