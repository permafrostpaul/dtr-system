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

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="bg-body-blue border border-white p-4 rounded-lg text-white">
                <div class="flex flex-col items-center space-y-4">
                    <svg class="w-24 h-24 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <div class="border-t border-white w-full pt-4">
                        <div class="text-center text-md">
                            <p class="font-semibold">Employee ID:</p>
                            <p>{{ $user->employeeid }}</p>
                        </div>
                        <hr class="my-2 border-white">
                        <div class="text-center text-md">
                            <p class="font-semibold">Name:</p>
                            <p>{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</p>
                        </div>
                        <hr class="my-2 border-white ">
                        <div class="text-center text-md">
                            <p class="font-semibold">Email:</p>
                            <p>{{ $user->email }}</p>
                        </div>
                        <hr class="my-2 border-white">
                        <div class="text-center text-md">
                            <p class="font-semibold">Position:</p>
                            <p>{{ $user->role }}</p>
                        </div>
                        <hr class="my-2 border-white">
                        <div class="text-center text-md">
                            <p class="font-bold">Work Station:</p>
                            <p>{{ $user->workstation }}</p>
                        </div>
                        <hr class="my-2 border-white">
                        <div class="text-center text-md">
                            <p class="font-bold">Assign Shift:</p>

                            @if(!empty($user->shift_name) && !empty($user->shift_time_only))
                            <p class="font-bold mt-1 text-custom-gray">Shift 1:</p>
                            <p>{{ $user->shift_name }}</p>
                            <p>{{ $user->shift_time_only }}</p>
                            @endif

                            @if(!empty($user->shift_name1) && !empty($user->shift_time_only1))

                            <p class="font-bold text-custom-gray mt-1">Shift 2:</p>
                            <p>{{ $user->shift_name1 }}</p>
                            <p>{{ $user->shift_time_only1 }}</p>
                            @endif

                            @if(!empty($user->shift_name2) && !empty($user->shift_time_only2))

                            <p class="font-bold text-custom-gray mt-1">Shift 3:</p>
                            <p>{{ $user->shift_name2 }}</p>
                            <p>{{ $user->shift_time_only2 }}</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-span-2 bg-body-blue p-4 border border-white rounded-lg text-white">
                <h2 class="text-center font-semibold text-lg mb-2">Log in Credentials</h2>
                <hr class="my-1 border-white">
                <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="space-y-3">
                        <div>
                            <label for="email" class="block text-xs font-medium">Email</label>
                            <input id="email" name="email" type="email" value="{{ $user->email }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <div>
                            <label for="password" class="block text-xs font-medium">New Password</label>
                            <input id="password" name="password" type="password" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-medium">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <button type="submit" class="w-full bg-custom-orange text-white font-bold py-2 px-3 rounded-md text-sm">Change Password</button>
                    </div>
                </form>

                <h2 class="text-center font-semibold text-lg mt-4 mb-2">Work Information</h2>
                <hr class="my-1 border-white">
                <form action="{{ route('admin.profile.updateWorkInfo') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <div>
                            <label for="workstation" class="block text-xs font-medium">Work Station</label>
                            <select id="workstation" name="workstation" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-10">
                                <option value="" disabled selected hidden></option>
                                <option value="Laguna - MIS Technical Area" {{ $user->workstation == 'Laguna - MIS Technical Area' ? 'selected' : '' }}>Laguna - MIS Technical Area</option>
                                <option value="Laguna - Sales Area" {{ $user->workstation == 'Laguna - Sales Area' ? 'selected' : '' }}>Laguna - Sales Area</option>
                                <option value="Laguna - Annex Workstation" {{ $user->workstation == 'Laguna - Aneex Workstation' ? 'selected' : '' }}>Laguna - Annex Workstation</option>
                                <option value="Cebu - MIS Technical Area" {{ $user->workstation == 'Cebu - MIS Technical Area' ? 'selected' : '' }}>Cebu - MIS Technical Area</option>
                                <option value="Parañaque - Innovato Office" {{ $user->workstation == 'Parañaque - Innovato Office' ? 'selected' : '' }}>Parañaque - Innovato Office</option>
                                <option value="CDO - MIS Technical Area" {{ $user->workstation == 'CDO - MIS Technical Area' ? 'selected' : '' }}>CDO - MIS Technical Area</option>
                                <option value="Pampanga - MIS Technical Area" {{ $user->workstation == 'Pampanga - MIS Technical Area' ? 'selected' : '' }}>Pampanga - MIS Technical Area</option>
                                <option value="Work From Home (WFH)" {{ $user->workstation == 'Work From Home (WFH)' ? 'selected' : '' }}>Work From Home (WFH)</option>
                                <option value="Official Business (OB - Field Work)" {{ $user->workstation == 'Official Business (OB - Field Work)' ? 'selected' : '' }}>Official Business (OB - Field Work)</option>
                            </select>
                        </div>
                        <!-- // <div>
                            <label for="shift_time" class="block text-xs font-medium">Assign Shift</label>
                            <select id="shift_time" name="shift_time" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-10">
                                <option value="" disabled>Select Shift</option>
                                <!-- Options here -->
                        <!-- </select>
                        </div> -->
                        <button type="submit" class="w-full bg-custom-orange text-white font-bold py-2 px-3 rounded-md text-sm">Update Work Information</button>
                    </div>
                </form>

                <h2 class="text-center font-semibold text-lg mt-4 mb-2">Personal Information</h2>
                <hr class="my-1 border-white">
                <form action="{{ route('admin.profile.updatePersonal') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <div>
                            <label for="firstname" class="block text-xs font-medium">Firstname</label>
                            <input id="firstname" name="firstname" type="text" value="{{ $user->firstname }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <div>
                            <label for="middlename" class="block text-xs font-medium">Middlename</label>
                            <input id="middlename" name="middlename" type="text" value="{{ $user->middlename }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <div>
                            <label for="lastname" class="block text-xs font-medium">Lastname</label>
                            <input id="lastname" name="lastname" type="text" value="{{ $user->lastname }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <div>
                            <label for="birthday" class="block text-sm font-medium">Birthday</label>
                            <input id="birthday" name="birthday" type="date" value="{{ old('birthday', $user->birthday) }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400">
                        </div>
                        <div>
                            <label for="contactnumber" class="block text-xs font-medium">Contact Number</label>
                            <input id="contactnumber" name="contactnumber" type="text" value="{{ $user->contactnumber }}" class="mt-1 block w-full bg-gray-200 text-gray-700 rounded-md border-gray-300 focus:ring focus:ring-opacity-50 focus:ring-blue-400 text-sm h-8">
                        </div>
                        <button type="submit" class="w-full bg-custom-orange text-white font-bold py-2 px-3 rounded-md text-sm">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>