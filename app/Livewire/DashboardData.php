<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Report;
use Livewire\Attributes\Computed;

class DashboardData extends Component
{
    public $subjects;        
    public $terms;       

    public $currentTerm;    

    #[Computed]
    public function lastReportGrades(){
        return Report::lastReportGrades();
    }

    #[Computed]
    public function last10GradesForEachSubject(){
        return Grade::last10GradesBySubject($this->currentTerm);
    }


    public function mount(){        
        $this->subjects = $this->lastReportGrades->pluck('subject')->unique('id');

        $this->terms = $this->lastReportGrades->pluck('term')->unique('id');

        $this->currentTerm = $this->terms->last();
        
    }

    public function render()
    {
        return view('livewire.dashboard-data');
    }
}
