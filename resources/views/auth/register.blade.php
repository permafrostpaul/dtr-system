
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Sign Up Header -->
        <div class="header bg-custom-white  py-4 flex items-center justify-center">
            <h1 class="text-2xl md:text-3xl lg:text-3xl font-sarala font-bold text-custom-blue relative">
                <span class="bg-gradient-to-r from-custom-blue via-blue-700 to-custom-blue bg-clip-text text-transparent">
                    Sign Up
                </span>
                <span class="absolute left-0 bottom-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-700 transform scale-x-0 transition-transform duration-500 ease-in-out group-hover:scale-x-100"></span>
            </h1>


        </div>

        <!-- Form Fields -->
        <div class="relative mt-10 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Left Side Fields -->
            <div class="space-y-6">
                <div class="relative">
                    <x-text-input id="employeeid" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="employeeid" :value="old('employeeid')" required autofocus autocomplete="employeeid" />
                    <x-input-label for="employeeid" :value="__('Employee ID')" class="absolute text-xs md:text-sm text-custom-blue  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('employeeid')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-text-input id="firstname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                    <x-input-label for="firstname" :value="__('First Name')" class="absolute text-xs md:text-sm text-custom-blue  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-text-input id="middlename" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="middlename" :value="old('middlename')" required autofocus autocomplete="middlename" />
                    <x-input-label for="middlename" :value="__('Middle Name')" class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-text-input id="lastname" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                    <x-input-label for="lastname" :value="__('Last Name')" class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-input-label for="workstation" :value="__('Work Station')" class="absolute text-xs md:text-sm text-custom-blue  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <select id="workstation" name="workstation" required autofocus autocomplete="off" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-orange bg-custom-white rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:outline-none focus:ring-0 focus:border-blue-600 peer">
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
            <div class="space-y-6">
                <div class="relative">
                    <x-text-input id="contactnumber" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="contactnumber" :value="old('contactnumber')" required autofocus autocomplete="off" />
                    <x-input-label for="contactnumber" :value="__('Contact Number')" class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('contactnumber')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-text-input id="address" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="text" name="address" :value="old('address')" required autofocus autocomplete="off" />
                    <x-input-label for="address" :value="__('Address')" class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-text-input id="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-custom-blue bg-transparent rounded-lg border border-custom-blue text-custom-blue border-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-label for="email" :value="__('Email')" class="absolute text-xs md:text-sm text-custom-blue  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="relative">
                    <x-password-input id="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-gray-900 bg-transparent rounded-lg border border-gray-300 text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password" required autocomplete="new-password" />

                    
                </div>

                <div class="relative">
                    <x-password-confirmation-input id="password_confirmation" class="block px-2.5 pb-2.5 pt-4 w-full text-sm md:text-base text-gray-900 bg-transparent rounded-lg border border-gray-300 text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center mt-8">
            <x-primary-button class="w-full md:w-1/3">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <!-- Already have an account link -->
        <div class="flex items-center justify-center mt-4">
            @if (Route::has('password.request'))
            <a class=" text-sm text-custom-blue  rounded-md focus:outline-none ">
                {{ __('Already have an account? ') }}
            </a>
            <a class="underline text-sm text-custom-orange hover:text-orange-900 hover:text-orange-900 rounded-md focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('  Sign in') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>