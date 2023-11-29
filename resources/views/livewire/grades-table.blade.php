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
                    @if ($t->id > $current_term->id || $t->id < $current_term->id)
                        <th scope="col" class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $t->name }}</th>
                    @else
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $t->name }}</th>
                    @endif
                    
                @endforeach                
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Past 2 Weeks</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                
                    @foreach ($subjects_grades_latest as $s)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $s->subject_name }}</td>
                        @foreach ($s->latest_grades as $g)
                            @if ($g != null)
                                @if ($g->term_id > $current_term->id || $g->term_id < $current_term->id)
                                    <td class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $g->gpa }} / {{ $g->letter }} </td>
                                @else
                                    @if (floatval($g->gpa) <= 2.60)    
                                        <td class="whitespace-nowrap px-3 py-4 text-sm bg-gray-100 text-orange-500 font-bold">{{ $g->gpa }} / {{ $g->letter }} </td>
                                    @else
                                        <td class="whitespace-nowrap px-3 py-4 text-sm bg-gray-100 text-gray-500">{{ $g->gpa }} / {{ $g->letter }} </td>
                                    @endif

                                @endif 
                                
                            @endif
                            
                        @endforeach
                    </tr>
                    @endforeach
                
            </tbody>
          </table>
          <div class="mt-4 sm:mt-0 mr-4 sm:flex-none float-right">
            <p class="mt-2 italic text-xs text-gray-700">Last Report: {{ $report_latest->date_received}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
