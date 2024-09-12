<x-app-layout>
   @if (session('status'))
   <div id="notification" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-custom-orange text-white px-6 py-3 rounded-md shadow-lg relative max-w-md mx-auto">
         <button type="button" onclick="hideNotification()" class="absolute top-2 right-2 text-white">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
               <path d="M8 6.293l3.707-3.707a1 1 0 0 1 1.415 1.415L9.415 7.707 13.12 11.412a1 1 0 0 1-1.415 1.415L8 9.121 4.293 12.828a1 1 0 0 1-1.415-1.415L6.585 8.293 3.88 5.586a1 1 0 0 1 1.415-1.415L8 6.293z" />
            </svg>
         </button>
         <p>{{ session('status') }}</p>
      </div>
   </div>
   <script>
      function hideNotification() {
         document.getElementById('notification').style.display = 'none';
      }
   </script>
   @endif


   <!-- Filters -->
   <div class="bg-body-blue text-white text-center p-4 rounded-lg mb-6">
      <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
         <form action="{{ route('attendance.filter') }}" method="GET" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/4 px-2">
               <label for="start" class="block text-sm font-medium text-center md:text-left">Start</label>
               <input type="date" id="start" name="start_date" value="{{ request('start_date') }}" class="block w-full px-2 py-1 mt-1 bg-custom-blue border-2 border-custom-orange text-white rounded-lg">
            </div>
            <div class="w-full md:w-1/4 px-2">
               <label for="end" class="block text-sm font-medium text-center md:text-left">End</label>
               <input type="date" id="end" name="end_date" value="{{ request('end_date') }}" class="block w-full px-2 py-1 mt-1 bg-custom-blue border-2 border-custom-orange text-white rounded-lg">
            </div>
            <div class="w-full md:w-1/4 px-2">
               <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
                  <button type="submit" formaction="{{ route('attendance.filter') }}" class="bg-custom-orange text-white font-bold py-2 px-4 rounded-md text-sm w-full md:w-auto md:px-6 md:py-2 md:w-max">Filter</button>
                  <a href="{{ route('attendance') }}" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-md text-sm w-full md:w-auto md:px-6 md:py-2 md:w-max">Show </a>
               </div>
            </div>
         </form>
      </div>
   </div>



   <!-- Attendance Table -->
   <div class="bg-body-blue p-6 rounded-lg overflow-x-auto">
      <table class="min-w-full text-sm text-center">
         <thead>
            <tr class="bg-custom-blue text-white">
               <th class="py-3 px-4 border-2 border-custom-orange">Date</th>
               <th class="py-3 px-4 border-2 border-custom-orange">Time in</th>
               <th class="py-3 px-4 border-2 border-custom-orange">Time out</th>
               <th class="py-3 px-4 border-2 border-custom-orange">Shift</th>

            </tr>
         </thead>
         <tbody>
            @forelse($attendanceSummaries as $attendanceSummary)
            <tr class="bg-custom-blue text-white border-b border-custom-orange">
               <td class="py-2 px-4 border-2 border-custom-orange">
                  {{ \Carbon\Carbon::parse($attendanceSummary->created_at)->format('F j, Y, l') }}
               </td>
               <td class="py-2 px-4 border-2 border-custom-orange">
                  {{ $attendanceSummary->time_in ? \Carbon\Carbon::parse($attendanceSummary->time_in)->format('h:i A') : 'Not recorded' }}
               </td>
               <td class="py-2 px-4 border-2 border-custom-orange">
                  {{ $attendanceSummary->time_out ? \Carbon\Carbon::parse($attendanceSummary->time_out)->format('h:i A') : 'Not recorded' }}
               </td>
               <td class="py-2 px-4 border-2 border-custom-orange">
                  {{ $attendanceSummary->user->shift_name}} - {{ $attendanceSummary->user->shift_time_only}}
               </td>

            </tr>
            @empty
            <tr>
               <td colspan="5" class="py-2 px-4 border-2 border-custom-orange text-center"></td>
            </tr>
            @endforelse
         </tbody>

      </table>
      <div class="mt-4">
         {{ $attendanceSummaries->links('pagination::tailwind') }}
      </div>

   </div>

   <div class="flex justify-center mt-6">
      <button class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-6 rounded-lg flex items-center space-x-2">
         <span>Export</span>
         <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8" />
         </svg>
      </button>
   </div>

</x-app-layout>