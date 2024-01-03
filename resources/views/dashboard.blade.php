<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-md py-8">
                {{-- Grades Table --}}
                
                <x-grades-table :$terms :$subjects :$currentTerm :$subjectsGrades />
            </div>
            {{-- Subject History Charts --}}
            <div class="grid sm:grid-cols-4 gap-3">
                @foreach ($subjectsGradesHistory as $s)
                    <div class="mt-4 justify-normal bg-white overflow-hidden shadow-md rounded-md py-8">
                        
                        @include('components.subject-grade-history', [
                            'term_id' => $currentTerm->id,
                            'subject_name' => $s->name,
                            'subject_id' => $s->id,
                            'subject_grades_dates' => $s->chart->dates,
                            'subject_grades_gpas' => $s->chart->gpas
                        ])
                    </div>  
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>


