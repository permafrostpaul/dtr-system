<x-admin-layout>
    @if (session('status'))
    <div id="notification" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-custom-orange text-white px-8 py-4 rounded-md shadow-lg relative max-w-md mx-auto">
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

    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Filters -->
        <div class="bg-body-blue text-white text-center p-4 rounded-lg mb-6">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <form action="{{ route('admin.employee-dtr.filter') }}" method="GET" class="flex flex-wrap w-full space-y-4 md:space-y-0">
                    <div class="w-full md:w-1/4 px-2">
                        <label for="user" class="block text-sm font-medium">Select Employee</label>
                        <select id="user" name="user_id" class="block w-full px-4 py-2 bg-custom-blue border-2 border-custom-orange text-white rounded-lg">
                            <option value="">All Employees</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->firstname }} {{ $user->lastname }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/4 px-2">
                        <label for="start" class="block text-sm font-medium">Start</label>
                        <input type="date" id="start" name="start_date" value="{{ request('start_date') }}" class="block w-full px-4 py-2 bg-custom-blue border-2 border-custom-orange text-white rounded-lg">
                    </div>
                    <div class="w-full md:w-1/4 px-2">
                        <label for="end" class="block text-sm font-medium">End</label>
                        <input type="date" id="end" name="end_date" value="{{ request('end_date') }}" class="block w-full px-4 py-2 bg-custom-blue border-2 border-custom-orange text-white rounded-lg">
                    </div>
                    <div class="w-full md:w-1/4 px-2">
                        <button type="submit" formaction="{{ route('admin.employee-dtr.filter') }}" class="w-full bg-custom-orange text-white font-bold py-2 px-4 rounded-md text-sm mt-4 md:mt-0">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="bg-body-blue p-4 md:p-6 rounded-lg overflow-x-auto">
            
            <table class="w-full text-sm text-center">
                <thead>
                    <tr class="bg-custom-blue text-white">
                        <th class="py-2 px-2 md:px-4 border-2 border-custom-orange">Employee</th>
                        <th class="py-2 px-2 md:px-4 border-2 border-custom-orange">Date</th>
                        <th class="py-2 px-2 md:px-4 border-2 border-custom-orange">Time in</th>
                        <th class="py-2 px-2 md:px-4 border-2 border-custom-orange">Time out</th>
                        <th class="py-2 px-2 md:px-4 border-2 border-custom-orange">Shift</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceSummaries as $attendanceSummary)
                    <tr class="bg-custom-blue text-white">
                        <td class="py-2 px-2 md:px-4 border-2 border-custom-orange">{{ $attendanceSummary->user->firstname }} {{ $attendanceSummary->user->lastname }}</td>
                        <td class="py-2 px-2 md:px-4 border-2 border-custom-orange">
                            {{ \Carbon\Carbon::parse($attendanceSummary->date)->format('F j, Y, l') }}
                        </td>
                        <td class="py-2 px-2 md:px-4 border-2 border-custom-orange">
                            {{ $attendanceSummary->time_in ? \Carbon\Carbon::parse($attendanceSummary->time_in)->format('h:i A') : 'Not recorded' }}
                        </td>
                        <td class="py-2 px-2 md:px-4 border-2 border-custom-orange">
                            {{ $attendanceSummary->time_out ? \Carbon\Carbon::parse($attendanceSummary->time_out)->format('h:i A') : 'Not recorded' }}
                        </td>
                        <td class="py-2 px-2 md:px-4 border-2 border-custom-orange">
                            {{ $attendanceSummary->user->shift_name}} - {{ $attendanceSummary->user->shift_time_only}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $attendanceSummaries->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Export Button -->
        <div class="flex justify-center mt-6">
            <a href="" class="bg-orange-600 hover:bg-orange-700 text-white py-2 px-6 rounded-lg flex items-center space-x-2">
                <span>Export Attendance</span>
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2M12 4v12m0-12 4 4m-4-4L8 8" />
                </svg>
            </a>
        </div>

    </div>
</x-admin-layout>