<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Current Grades</h1>
        
      </div>
      
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Class</th>
                @foreach ($terms as $t)
                    <th scope="col" class=" {{ !($t->id == $current_term->id) ? 'hidden md:table-cell' : '' }} px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $t->name }}</th>    
                @endforeach                
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lo/Avg/Hi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($subjects_grades_latest as $s)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $s->subject_name }}</td>
                            @foreach ($s->latest_grades as $g)
                                @if ($g != null)
                                    <th scope="col" class=" {{ !($t->id == $current_term->id) ? 'hidden md:table-cell' : '' }} 
                                        {{ ((floatval($g->gpa) <= 2.60) ? 'text-orange-500 font-bold' : 'text-gray-500') }} 
                                        px-3 py-3.5 text-left text-sm text-gray-900 ">{{ $g->gpa }} / {{ $g->letter }}</th> 
                                @endif
                            @endforeach
                    </tr>
                @endforeach
            </tbody>
          </table>
          <div class="mt-4 sm:mt-0 mr-4 sm:flex-none float-right">
            <p class="italic text-xs text-gray-700">Last Report: {{ $report_latest->date_received}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
