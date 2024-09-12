<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="header bg-custom-white  py-4 flex items-center justify-center">
            <h1 class="text-2xl md:text-3xl lg:text-3xl font-sarala font-bold text-custom-blue relative">
                <span class="bg-gradient-to-r from-custom-blue via-blue-700 to-custom-blue bg-clip-text text-transparent">
                    Daily Time Record System
                </span>
                <span class="absolute left-0 bottom-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-700 transform scale-x-0 transition-transform duration-500 ease-in-out group-hover:scale-x-100"></span>
            </h1>


        </div>

        <div>
            <x-input-label for="email" :value="__('Sign in')" class="text-lg md:text-xl mt-12 font-sarala font-bold text-custom-orange " />
        </div>

        <div class="container mx-auto px-4 py-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="relative mt-10">
                    <x-text-input
                        id="email"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-custom-blue bg-transparent rounded-lg border  border-custom-blue appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer"
                        placeholder=" "
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="off" />
                    <x-input-label
                        for="email"
                        :value="__('Enter your Email')"
                        class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Input -->
                <div class="relative mt-6">
                    <x-text-input
                        id="password"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-custom-blue bg-transparent rounded-lg border border-custom-blue appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer"
                        placeholder=" "
                        type="password"
                        name="password"
                        :value="old('password')"
                        required
                        autocomplete="off" />
                    <x-input-label
                        for="password"
                        :value="__('Enter your Password')"
                        class="absolute text-xs md:text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-custom-blue">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button class="w-full md:w-auto mx-auto text-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <div class="flex justify-center mt-4">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="underline text-sm text-custom-orange hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <div class="flex justify-center mt-4">
                    @if (Route::has('password.request'))
                    <a class="text-sm text-custom-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Dont have an account? ') }}
                    </a>
                    <a class="underline text-sm text-custom-blue hover:text-blue-600 rounded-md" href="{{ route('register') }}">
                        {{ __('Sign up') }}
                    </a>
                    @endif
                </div>
        </div>
    </form>
</x-guest-layout>