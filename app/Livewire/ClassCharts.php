<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Term;

class ClassCharts extends Component
{
    public $subjects;
    public $current_term;

    public function mount(){
        $this->subjects = Subject::all();
        $this->current_term = Term::findCurrentTerm();
    }

    public function render()
    {
        return view('livewire.class-charts');
    }
}
