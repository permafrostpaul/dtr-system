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
    <<div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg mx-auto bg-custom-blue text-white p-6 rounded-lg">
            <h2 class="text-center text-2xl font-bold mb-4">ADMIN SIGN UP</h2>
            <form action="{{ route('admin.signup.store') }}" method="POST">
                @csrf
                <!-- Hidden input to set default role to admin -->
                <input type="hidden" name="role" value="admin">

                <div class="grid grid-cols-2 gap-4">
                    <!-- Left Side Fields -->
                    <div class="space-y-10">
                        <div class="relative">
                            <x-text-input id="employeeid" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="employeeid" :value="old('employeeid')" required autofocus autocomplete="employeeid" />
                            <x-input-label for="employeeid" :value="__('Employee ID')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('employeeid')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-text-input id="firstname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                            <x-input-label for="firstname" :value="__('First Name')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-text-input id="middlename" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="middlename" :value="old('middlename')" required autofocus autocomplete="middlename" />
                            <x-input-label for="middlename" :value="__('Middle Name')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-text-input id="lastname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                            <x-input-label for="lastname" :value="__('Last Name')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-input-label for="workstation" :value="__('Work Station')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <select id="workstation" name="workstation" required autofocus autocomplete="off" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-custom-blue rounded-lg border border-white appearance-none dark:text-white dark:border-white focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="" disabled selected hidden></option>
                                <option value="Laguna - MIS Technical Area">Laguna - MIS Technical Area</option>
                                <option value="Laguna - Sales Area">Laguna - Sales Area</option>
                                <option value="Laguna - Annex Workstation">Laguna - Annex Workstation</option>
                                <option value="Cebu - MIS Technical Area">Cebu - MIS Technical Area</option>
                                <option value="Parañaque - Innovato Office">Parañaque - Innovato Office</option>
                                <option value="CDO - MIS Technical Area">CDO - MIS Technical Area</option>
                                <option value="Pampanga - MIS Technical Area">Pampanga - MIS Technical Area</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right Side Fields -->
                    <div class="space-y-10">
                        <div class="relative">
                            <x-text-input id="contactnumber" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="contactnumber" :value="old('contactnumber')" required autofocus autocomplete="off" />
                            <x-input-label for="contactnumber" :value="__('Contact Number')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('contactnumber')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-text-input id="address" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="text" name="address" :value="old('address')" required autofocus autocomplete="off" />
                            <x-input-label for="address" :value="__('Address')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-text-input id="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                            <x-input-label for="email" :value="__('Email')" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-blue px-2 peer-focus:px-2 peer-focus:text-white peer-focus:dark:text-white peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-password-input id="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password" required autocomplete="new-password" />
                            
                           
                        </div>

                        <div class="relative">
                            <x-password-confirmation-input id="password_confirmation" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-3" />
                        </div>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button type="submit" formaction="{{ route('admin.signup.store') }}" class="w-full mt-4 bg-custom-orange text-white font-bold py-2 px-3 rounded-md text-sm">CREATE ACCOUNT</button>
                </div>
            </form>
            <a href="{{ route('manage-account') }}" class="text-custom-orange text-sm mt-4 inline-block flex  ">Back to Manage Accounts</a>
        </div>
        </div>
</x-admin-layout>