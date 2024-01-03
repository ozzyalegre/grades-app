<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-lg font-semibold leading-6 text-gray-900">Latest Grades</h1>
            <br>
        </div>
    </div>
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-center sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Class</th>
                        @foreach ($terms as $t)
                            <th scope="col" class=" {{ !($t->id == $currentTerm->id) ? 'hidden md:table-cell' : '' }} px-3 py-3.5 text-center text-sm font-semibold text-gray-900">{{ $t->name }}</th>    
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($subjectsGrades as $s)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $s->name }}</td>
                            @foreach ($s->grades as $g)
                                @if ($g != null)
                                    
                                    <td scope="col" class="{{ !($g->term->id == $currentTerm->id) ? 'hidden sm:table-cell' : '' }}">
                                        @php 
                                            // Simple Logic for grade color warnings
                                            if (floatval($g->gpa) <= 5.00){
                                                $calc_gpa = (floatval($g->gpa)/4)*100;
                                            }
                                            else{
                                                $calc_gpa = floatval($g->gpa);
                                            }
                                            
                                        @endphp
                                        <div class= "{{ ($calc_gpa <= 65 ? 'text-yellow-800 bg-yellow-100' : 'text-green-800 bg-green-100') }} 
                                        rounded-md text-xs font-medium px-1 py-1 w-14 h-14 text-center m-auto">
                                            <div class="text-lg">{{ $g->letter }}</div>
                                            <div>{{ $g->gpa }}</div>
                                        </div>
                                    </td> 
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
  
