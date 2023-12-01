<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Report;

class DashboardData extends Component
{
    public $reports;

    public function mount(){
        $this->reports = Report::with(['grade', 'subject', 'term'])->get();
        foreach ($this->reports as $key => $g) {
            $grade = $g->grade;
            $subject = $g->subject;
            $term = $g->term;

            dd($grade, $subject, $term);
        }
    }

    public function render()
    {
        return view('livewire.dashboard-data');
    }
}
