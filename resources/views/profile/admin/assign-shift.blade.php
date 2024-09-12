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

    <div x-data="{ showModal: false }" @keydown.escape.window="showModal = false">
        <!-- Trigger for Modal -->
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg mx-auto">
                <!-- Modal Content -->
                @foreach ($users as $user)
                <div class="text-center mb-6">
                    <h2 id="user-name" class="text-xl font-semibold">Manage Shift - {{ $user->firstname }} {{ $user->lastname }} </h2>
                </div>
                @endforeach
                <form id="manageShiftForm" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Shift Section -->
                    <template x-for="shiftIndex in [0, 1, 2]" :key="shiftIndex">
                        <div class="grid grid-cols-1 gap-4 mb-4">
                            <h3 class="text-sm font-bold" x-text="'Shift ' + (shiftIndex + 1)"></h3>
                            <div>
                                <label :for="'shift_name' + shiftIndex" class="block text-sm font-medium">Shift</label>
                                <select :id="'shift_name' + shiftIndex" :name="'shift_name' + (shiftIndex === 0 ? '' : shiftIndex)" class="block w-full mt-1 bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-10">
                                    <option value="" disabled>Select Shift</option>
                                    <option value="Early Morning Shift 1">Early Morning Shift 1</option>
                                    <option value="Early Morning Shift 2">Early Morning Shift 2</option>
                                    <option value="Regular Shift 1">Regular Shift 1</option>
                                    <option value="Regular Shift 2">Regular Shift 2</option>
                                </select>
                            </div>
                            <div>
                                <label :for="'shift_time' + shiftIndex" class="block text-sm font-medium">Time</label>
                                <input type="text" :id="'shift_time' + shiftIndex" :name="'shift_time_only' + (shiftIndex === 0 ? '' : shiftIndex)" placeholder="09:00AM - 06:00PM" class="block w-full mt-1 bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-10" />
                            </div>
                            <div>
                                <label :for="'rest_day' + shiftIndex" class="block text-sm font-medium">Rest Day</label>
                                <select :id="'rest_day' + shiftIndex" :name="'rest_day' + (shiftIndex === 0 ? '' : shiftIndex)" class="block w-full mt-1 bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-10">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                    </template>

                    <!-- Days Checkbox -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium">Days</label>
                        <div class="grid grid-cols-7 gap-2">
                            <label><input type="checkbox" name="days[]" value="Mon"> Mon</label>
                            <label><input type="checkbox" name="days[]" value="Tue"> Tue</label>
                            <label><input type="checkbox" name="days[]" value="Wed"> Wed</label>
                            <label><input type="checkbox" name="days[]" value="Thu"> Thu</label>
                            <label><input type="checkbox" name="days[]" value="Fri"> Fri</label>
                            <label><input type="checkbox" name="days[]" value="Sat"> Sat</label>
                            <label><input type="checkbox" name="days[]" value="Sun"> Sun</label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Save</button>
                        <button type="button" @click="showModal = false" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-body-blue min-h-screen flex flex-col items-center px-4">
        <!-- Search Bar -->
        <form action="{{ route('assign-shift.index') }}" method="GET" class="relative w-full max-w-3xl">
            <div class="w-full">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        class="w-full p-4 rounded-full shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Search..."
                        value="{{ request('search') }}"> <!-- Keeps the search term in the input after search -->
                    <button formaction="{{ route('assign-shift.index') }}"
                        class="absolute right-2 top-2 p-3 bg-orange-500 text-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M15 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <!-- Employee Cards -->
        <div class="overflow-y-auto max-h-screen mt-10 w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
                @foreach ($users as $user)
                <div class="bg-white p-6 rounded-lg shadow-lg border-4 border-custom-orange">
                    <div class="text-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-semibold mb-4 text-custom-blue">{{ $user->firstname }} {{ $user->lastname }}</h2>

                        <!-- Scrollable Container -->
                        <div class="overflow-y-auto max-h-80 mx-auto">
                            @foreach (range(0, 3) as $index) <!-- Adjust the range based on your max number of shifts -->
                            @php
                            $shiftName = $index == 0 ? 'shift_name' : 'shift_name' . $index;
                            $shiftTime = $index == 0 ? 'shift_time_only' : 'shift_time_only' . $index;
                            $restDay = $index == 0 ? 'rest_day' : 'rest_day' . $index;
                            $daysField = $index == 0 ? 'days' : 'days' . $index;
                            $days = json_decode($user->$daysField, true);
                            @endphp

                            @if (!empty($user->$shiftName) && !empty($user->$shiftTime))
                            <div class="shift-details mb-6 p-4 border rounded-lg shadow-md bg-gray-100">
                                <h3 class="text-xl font-semibold mb-2 text-custom-orange">Shift {{ $index + 1 }}</h3>
                                <p class="text-sm text-gray-700 mb-1">
                                    <span class="font-medium ">Shift Name:</span> {{ $user->$shiftName }}
                                </p>
                                <p class="text-sm text-gray-700 mb-1">
                                    <span class="font-medium">Rest Day:</span> {{ $user->$restDay ?? 'None' }}
                                </p>
                                <p class="text-sm text-gray-700 mb-1">
                                    <span class="font-medium">Days:</span> {{ !empty($days) ? implode(', ', $days) : 'No days selected' }}
                                </p>
                                <p class="text-sm text-gray-700 mb-1">
                                    <svg class="inline w-6 h-6 text-gray-800 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="gray" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-medium">Time:</span> {{ $user->$shiftTime }}
                                </p>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>



                    <div class="text-center mt-4">
                        <button class="text-orange-500 font-semibold" data-user-id="{{ $user->id }}" onclick="openModal(this)">Manage Shift</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="shiftModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen p-4 ">
            <div class="bg-custom-blue rounded-lg shadow-lg w-full max-w-lg mx-auto overflow-hidden sm:w-3/4 md:w-1/2 lg:w-1/3">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4 text-custom-orange">Manage Shift</h2>

                    <!-- Form -->
                    <form id="shiftForm" method="POST" action="{{ route('assign-shift.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" id="userId">

                        <!-- Shift Name -->

                        <h3 class=" text-center mt-6 text-xl font-bold mb-4 text-custom-orange">Shift 1</h3>

                        <label for="shift_name" class="block text-sm font-medium text-white mb-2">Shift Name</label>
                        <select id="shift_name" name="shift_name" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="" disabled selected>Select Shift</option>
                            <option value="Early Morning Shift 1">Early Morning Shift 1</option>
                            <option value="Early Morning Shift 2">Early Morning Shift 2</option>
                            <option value="Early Morning Shift 3">Early Morning Shift 3</option>
                            <option value="Morning Shift 1">Morning Shift 1</option>
                            <option value="Morning Shift 2">Morning Shift 2</option>
                            <option value="Regular Shift 1">Regular Shift 1</option>
                            <option value="Regular Shift 2">Regular Shift 2</option>
                            <option value="Mid Shift 1">Mid Shift 1</option>
                            <option value="Mid Shift 2">Mid Shift 2</option>
                            <option value="Store Retail Shift">Store Retail Shift</option>
                            <option value="Noon Shift 1">Noon Shift 1</option>
                            <option value="Noon Shift 2">Noon Shift 2</option>
                            <option value="Noon Shift 3">Noon Shift 3</option>
                            <option value="Night Shift 1">Night Shift 1</option>
                            <option value="Night Shift 2">Night Shift 2</option>
                            <option value="Night Shift 3">Night Shift 3</option>
                            <!-- Add other shift name options -->
                        </select>

                        <!-- Shift Time -->
                        <label for="shift_time_only" class="block text-sm font-medium text-white mb-2 mt-4">Shift Time</label>
                        <select id="shift_time_only" name="shift_time_only" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="" disabled selected>Select Time</option>
                            <option value="02:00AM - 11:00AM">02:00AM - 11:00AM</option>
                            <option value="03:00AM - 12:00PM">03:00AM - 12:00PM</option>
                            <option value="05:00AM - 2:00PM">05:00AM - 2:00PM</option>
                            <option value="06:00AM - 3:00PM">06:00AM - 3:00PM</option>
                            <option value="07:00AM - 4:00PM">07:00AM - 4:00PM</option>
                            <option value="08:00AM - 5:00PM">08:00AM - 5:00PM</option>
                            <option value="09:00AM - 6:00PM">09:00AM - 6:00PM</option>
                            <option value="10:00AM - 7:00PM">10:00AM - 7:00PM</option>
                            <option value="11:00AM - 8:00PM">11:00AM - 8:00PM</option>
                            <option value="12:00PM - 09:00PM">12:00PM - 09:00PM</option>
                            <option value="01:00PM - 10:00PM">01:00PM - 10:00PM</option>
                            <option value="02:00PM - 11:00PM">02:00PM - 11:00PM</option>
                            <option value="09:00PM - 06:00AM">09:00PM - 06:00AM</option>
                            <option value="10:00PM - 07:00AM">10:00PM - 07:00AM</option>
                            <option value="11:00PM - 08:00AM">11:00PM - 08:00AM</option>
                            <!-- Add other shift time options -->
                        </select>

                        <!-- Rest Day -->
                        <label for="rest_day" class="block text-sm font-medium text-white mb-2 mt-4">Rest Day</label>
                        <select id="rest_day" name="rest_day" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="" disabled selected>Select Rest Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>

                        <!-- Days -->
                        <div class="block text-sm font-medium text-white mt-4">Days</div>
                        <div class="flex flex-wrap space-x-4 mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Mon" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Mon</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Tues" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Tue</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Wed" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Wed</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Thurs" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Thu</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Fri" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Fri</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Sat" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Sat</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="days[]" value="Sun" class="form-checkbox text-blue-500">
                                <span class="ml-1 text-white">Sun</span>
                            </label>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400" onclick="closeModal()">Cancel</button>
                            <button type="submit" class="bg-custom-orange text-white py-2 px-4 rounded-md hover:bg-orange-600">Save Shifts</button>
                        </div>
                        <button type="button" id="add-shift-btn" class="text-orange-500 font-semibold mt-4">Add Shift</button>
                        <button type="button" id="hide-shifts-btn" class="text-center text-green-500 font-semibold py-2 px-4 rounded-md hidden">Hide Shifts</button>

                        <!-- Title for Shift 1 -->
                        <div id="shift2-form" class="hidden mt-4">
                            <h3 class=" text-center mt-6 text-xl font-bold mb-4 text-custom-orange">Shift 2</h3>
                            <label for="shift_name1" class="block text-sm font-medium text-white mb-2">Shift Name</label>
                            <select id="shift_name1" name="shift_name1" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="" disabled selected>Select Shift</option>
                                <option value="Early Morning Shift 1">Early Morning Shift 1</option>
                                <option value="Early Morning Shift 2">Early Morning Shift 2</option>
                                <option value="Early Morning Shift 3">Early Morning Shift 3</option>
                                <option value="Morning Shift 1">Morning Shift 1</option>
                                <option value="Morning Shift 2">Morning Shift 2</option>
                                <option value="Regular Shift 1">Regular Shift 1</option>
                                <option value="Regular Shift 2">Regular Shift 2</option>
                                <option value="Mid Shift 1">Mid Shift 1</option>
                                <option value="Mid Shift 2">Mid Shift 2</option>
                                <option value="Store Retail Shift">Store Retail Shift</option>
                                <option value="Noon Shift 1">Noon Shift 1</option>
                                <option value="Noon Shift 2">Noon Shift 2</option>
                                <option value="Noon Shift 3">Noon Shift 3</option>
                                <option value="Night Shift 1">Night Shift 1</option>
                                <option value="Night Shift 2">Night Shift 2</option>
                                <option value="Night Shift 3">Night Shift 3</option>
                                <!-- Add other shift name options -->
                            </select>

                            <!-- Shift Time -->
                            <label for="shift_time_only1" class="block text-sm font-medium text-white mb-2 mt-4">Shift Time</label>
                            <select id="shift_time_only1" name="shift_time_only1" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="" disabled selected>Select Time</option>
                                <option value="02:00AM - 11:00AM">02:00AM - 11:00AM</option>
                                <option value="03:00AM - 12:00PM">03:00AM - 12:00PM</option>
                                <option value="05:00AM - 2:00PM">05:00AM - 2:00PM</option>
                                <option value="06:00AM - 3:00PM">06:00AM - 3:00PM</option>
                                <option value="07:00AM - 4:00PM">07:00AM - 4:00PM</option>
                                <option value="08:00AM - 5:00PM">08:00AM - 5:00PM</option>
                                <option value="09:00AM - 6:00PM">09:00AM - 6:00PM</option>
                                <option value="10:00AM - 7:00PM">10:00AM - 7:00PM</option>
                                <option value="11:00AM - 8:00PM">11:00AM - 8:00PM</option>
                                <option value="12:00PM - 09:00PM">12:00PM - 09:00PM</option>
                                <option value="01:00PM - 10:00PM">01:00PM - 10:00PM</option>
                                <option value="02:00PM - 11:00PM">02:00PM - 11:00PM</option>
                                <option value="09:00PM - 06:00AM">09:00PM - 06:00AM</option>
                                <option value="10:00PM - 07:00AM">10:00PM - 07:00AM</option>
                                <option value="11:00PM - 08:00AM">11:00PM - 08:00AM</option>
                                <!-- Add other shift time options -->
                            </select>

                            <!-- Rest Day -->
                            <label for="rest_day1" class="block text-sm font-medium text-white mb-2 mt-4">Rest Day</label>
                            <select id="rest_day1" name="rest_day1" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="" disabled selected>Select Rest Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                            <!-- Days -->
                            <div class="block text-sm font-medium text-white mt-4">Days</div>
                            <div class="flex flex-wrap space-x-4 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Mon" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Mon</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Tues" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Tue</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Wed" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Wed</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Thurs" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Thu</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Fri" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Fri</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Sat" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Sat</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="days1[]" value="Sun" class="form-checkbox text-blue-500">
                                    <span class="ml-1 text-white">Sun</span>
                                </label>
                            </div>

                            <div id="shift3-form" class="hidden mt-4">
                                <h3 class=" text-center mt-6 text-xl font-bold mb-4 text-custom-orange">Shift 3</h3>
                                <label for="shift_name2" class="block text-sm font-medium text-white mb-2">Shift Name</label>
                                <select id="shift_name2" name="shift_name2" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="" disabled selected>Select Shift</option>
                                    <option value="Early Morning Shift 1">Early Morning Shift 1</option>
                                    <option value="Early Morning Shift 2">Early Morning Shift 2</option>
                                    <option value="Early Morning Shift 3">Early Morning Shift 3</option>
                                    <option value="Morning Shift 1">Morning Shift 1</option>
                                    <option value="Morning Shift 2">Morning Shift 2</option>
                                    <option value="Regular Shift 1">Regular Shift 1</option>
                                    <option value="Regular Shift 2">Regular Shift 2</option>
                                    <option value="Mid Shift 1">Mid Shift 1</option>
                                    <option value="Mid Shift 2">Mid Shift 2</option>
                                    <option value="Store Retail Shift">Store Retail Shift</option>
                                    <option value="Noon Shift 1">Noon Shift 1</option>
                                    <option value="Noon Shift 2">Noon Shift 2</option>
                                    <option value="Noon Shift 3">Noon Shift 3</option>
                                    <option value="Night Shift 1">Night Shift 1</option>
                                    <option value="Night Shift 2">Night Shift 2</option>
                                    <option value="Night Shift 3">Night Shift 3</option>
                                    <!-- Add other shift name options -->
                                </select>

                                <!-- Shift Time -->

                                <label for="shift_time_only2" class="block text-sm font-medium text-white mb-2 mt-4">Shift Time</label>
                                <select id="shift_time_only2" name="shift_time_only2" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="" disabled selected>Select Time</option>
                                    <option value="02:00AM - 11:00AM">02:00AM - 11:00AM</option>
                                    <option value="03:00AM - 12:00PM">03:00AM - 12:00PM</option>
                                    <option value="05:00AM - 2:00PM">05:00AM - 2:00PM</option>
                                    <option value="06:00AM - 3:00PM">06:00AM - 3:00PM</option>
                                    <option value="07:00AM - 4:00PM">07:00AM - 4:00PM</option>
                                    <option value="08:00AM - 5:00PM">08:00AM - 5:00PM</option>
                                    <option value="09:00AM - 6:00PM">09:00AM - 6:00PM</option>
                                    <option value="10:00AM - 7:00PM">10:00AM - 7:00PM</option>
                                    <option value="11:00AM - 8:00PM">11:00AM - 8:00PM</option>
                                    <option value="12:00PM - 09:00PM">12:00PM - 09:00PM</option>
                                    <option value="01:00PM - 10:00PM">01:00PM - 10:00PM</option>
                                    <option value="02:00PM - 11:00PM">02:00PM - 11:00PM</option>
                                    <option value="09:00PM - 06:00AM">09:00PM - 06:00AM</option>
                                    <option value="10:00PM - 07:00AM">10:00PM - 07:00AM</option>
                                    <option value="11:00PM - 08:00AM">11:00PM - 08:00AM</option>
                                    <!-- Add other shift time options -->
                                </select>

                                <!-- Rest Day -->
                                <label for="rest_day2" class="block text-sm font-medium text-white mb-2 mt-4">Rest Day</label>
                                <select id="rest_day2" name="rest_day2" class="block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="" disabled selected>Select Rest Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>

                                <!-- Days -->
                                <div class="block text-sm font-medium text-white mt-4">Days</div>
                                <div class="flex flex-wrap space-x-4 mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Mon" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Mon</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Tues" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Tue</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Wed" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Wed</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Thurs" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Thu</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Fri" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Fri</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Sat" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Sat</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="days2[]" value="Sun" class="form-checkbox text-blue-500">
                                        <span class="ml-1 text-white">Sun</span>
                                    </label>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
    function openModal(button) {
        const userId = button.getAttribute('data-user-id');
        document.getElementById('userId').value = userId;
        document.getElementById('shiftModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('shiftModal').classList.add('hidden');
    }

    let currentShift = 0; // 0 for no shift, 1 for Shift 2, 2 for Shift 3

    document.getElementById('add-shift-btn').addEventListener('click', function() {
        const shift2Form = document.getElementById('shift2-form');
        const shift3Form = document.getElementById('shift3-form');
        const hideShiftsBtn = document.getElementById('hide-shifts-btn');

        // Show forms based on current state
        if (currentShift === 0) {
            shift2Form.classList.remove('hidden');
            currentShift = 1;
            hideShiftsBtn.classList.remove('hidden');
        } else if (currentShift === 1) {
            shift3Form.classList.remove('hidden');
            currentShift = 2;
        }
    });

    document.getElementById('hide-shifts-btn').addEventListener('click', function() {
        const shift2Form = document.getElementById('shift2-form');
        const shift3Form = document.getElementById('shift3-form');
        const hideShiftsBtn = document.getElementById('hide-shifts-btn');

        shift2Form.classList.add('hidden');
        shift3Form.classList.add('hidden');
        currentShift = 0;
        hideShiftsBtn.classList.add('hidden');
    });
</script>