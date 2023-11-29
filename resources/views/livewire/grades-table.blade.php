<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Current Grades</h1>
        <p class="mt-2 text-sm text-gray-700">Last Updated: {{ $report_latest->date_received}}</p>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add user</button>
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
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $t->name }}</th>
                @endforeach                
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Trend</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                
                    @foreach ($subjects_grades_latest as $s)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $s->subject_name }}</td>
                        @foreach ($s->latest_grades as $g)
                            @if ($g != null)    
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $g->gpa }} / {{ $g->letter }} </td>
                            @endif
                            
                        @endforeach
                    </tr>
                    @endforeach
                
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
