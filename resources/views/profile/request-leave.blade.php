<x-app-layout>
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

    <div class="w-full max-w-3xl mx-auto mt-6 p-8 bg-custom-blue rounded-lg shadow-lg">
        <div class="p-6 border-4 border-blue-300 rounded-2xl w-full sm:w-96">

            <h2 class="text-white text-center text-2xl font-semibold mb-6">Request Leave</h2>

            <form method="POST" action="{{ route('request-leave.store') }}">
                @csrf
                <!-- Date From -->
                <div class="mb-4">
                    <label class="block text-white text-sm font-medium mb-2" for="date_from">Date From</label>
                    <input id="date_from" name="date_from" type="text" datepicker datepicker-autohide datepicker-format="mm/dd/yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <!-- Date To -->
                <div class="mb-4">
                    <label class="block text-white text-sm font-medium mb-2" for="date_to">Date To</label>
                    <input id="date_to" name="date_to" type="text" datepicker datepicker-autohide datepicker-format="mm/dd/yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <!-- Type of Leave -->
                <div class="mb-4">
                    <label class="block text-white text-sm font-medium mb-2" for="leave_type">Type of Leave</label>
                    <select id="leave_type" name="leave_type" class="block w-full bg-white text-black border border-gray-400 hover:border-gray-500 px-4 py-2 rounded-lg shadow-lg focus:outline-none focus:shadow-outline">
                        <!-- Add options dynamically or manually -->
                        <option>Sick Leave</option>
                        <option>Vacation Leave</option>
                        <option>Sick Leave c/0 555</option>
                        <option>Maternity Leave</option>
                        <option>Paternity Leave</option>
                        <option>Emergency Leave</option>
                        <option>Special Leave without Pay</option>
                        <option>Bereavement Leave</option>
                    </select>
                </div>
                <!-- Leave Duration -->
                <div class="mb-4">
                    <label class="block text-white text-sm font-medium mb-2" for="duration">Leave Duration</label>
                    <input id="duration" name="duration" type="text" placeholder="Leave Duration" class="w-full px-4 py-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                </div>
                <!-- Reason -->
                <div class="mb-6">
                    <label class="block text-white text-sm font-medium mb-2" for="reason">Reason</label>
                    <input id="reason" name="reason" type="text" placeholder="Reason" class="w-full px-4 py-2 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                </div>
                <button type="submit" formaction="{{ route('request-leave.store') }}" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">Submit</button>
            </form>

        </div>
    </div>

</x-app-layout>

<!-- Include Flowbite Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.1/datepicker.js"></script>