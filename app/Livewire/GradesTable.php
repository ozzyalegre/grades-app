<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Term;
use App\Models\Grade;
use App\Models\Report;
use App\Models\Subject;

class GradesTable extends Component
{   
    public $terms;
    public $subjects_grades_latest = [];
    public $report_latest;

    public function mount(){
        $this->terms = Term::all();
        $this->report_latest = Report::get()->last();

        $subjects_list = Subject::all();
        foreach ($subjects_list as $s) {
            $list_entry = (object) [
                'subject_name' => $s->name,
                'latest_grades' => []
            ];
            foreach ($this->terms as $t){
                $latest_grade = Grade::getLatestGrade($t->id, $s->id);
                array_push($list_entry->latest_grades, $latest_grade);
            }
            array_push($this->subjects_grades_latest, $list_entry);
        }

    }

    public function render()
    {
        return view('livewire.grades-table');
    }
}
