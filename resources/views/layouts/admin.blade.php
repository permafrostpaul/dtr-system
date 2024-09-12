<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/Innovato_logo.png') }}" type="image/png">

    <title>{{ config('app.name', 'Laravel') }} - DTR System</title>

    <!-- Fonts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-body-blue flex justify-center items-center relative">
    <!-- <img src="{{ asset('/images/background.png') }}" alt="Background Image" class="max-w-full h-auto absolute inset-0 z-0 mx-auto">
    <div class="z-0 relative">  -->

    <!-- Sidebar -->
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-custom-blue  border-b border-body-blue">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button id="sidebar-toggle" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-custom-orange focus:outline-none focus:ring-2 focus:ring-custom-orange">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="{{asset('/images/Innovato_logo.png')}}" class="h-8 me-3" alt="Innovato logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">DTR - System</span>
                    </a>

                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <button id="user-menu-toggle" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 focus:ring-gray-600" aria-expanded="false">
                            <span class="sr-only">Open user menu</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-custom-blue border-b border-custom-gray sm:translate-x-0 bg-custom-blue" aria-label="Sidebar">
        <div class="h-full px-3 pb-4  bg-custom-blue">
            <ul class="space-y-2 font-medium mb-4">
                <li>
                    <a href="#" class="flex items-center justify-between p-2 mb-4 text-gray-900 rounded-lg text-white">
                        <div class="flex items-center mt-[-2rem]">
                            <!-- User icon -->
                            <svg class="w-[39px] h-[41px] text-gray-800 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd" />
                            </svg>

                            <!-- User name -->
                            <span class=" text-md font-semibold sm:text-md whitespace-nowrap text-white">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </span>
                            <div x-data="{ open: false }" class="relative ">
                                <button @click="open = !open" class="flex items-center">
                                    <svg class="w-[20px] h-[20px] text-custom-orange mr-[2rem]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 text-right w-32 bg-custom-blue z-30 rounded-lg shadow-lg">
                                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 text-gray-200 hover:bg-custom-orange rounded-lg">
                                        <svg class="w-5 h-5 text-gray-800 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm text-white">Help</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <nav :href="route('logout')"
                                            onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                            <nav>
                                                <a href="#" class="flex items-center px-4 py-2 text-gray-700 text-gray-200 hover:bg-custom-orange rounded-lg">
                                                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                                    </svg>
                                                    <span class="text-sm ml-1 text-white">Sign Out</span>
                                                </a>
                                            </nav>


                                </div>
                    </a>
        </div>

        <!-- Dropdown icon -->
        <li>
            <a href="{{ route('admin-dashboard') }}"
                class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group
       {{ request()->routeIs('admin-dashboard') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">

                <!-- SVG Icon -->
                <svg class="w-6 h-6 {{ request()->routeIs('admin-dashboard') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                </svg>

                <!-- Text -->
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('admin-dashboard') ? 'text-custom-orange' : '' }}">
                    Dashboard
                </span>

                <!-- Right Border Line -->
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
              {{ request()->routeIs('admin-dashboard') ? '' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin-profile') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group 
       {{ request()->routeIs('admin-profile') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">

                <svg class="w-6 h-6 {{ request()->routeIs('admin-profile') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('admin-profile') ? 'text-custom-orange' : '' }}">
                    Profile
                </span>

                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
              {{ request()->routeIs('admin-profile') ? '' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin-calendar') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group {{ request()->routeIs('admin-calendar') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('admin-calendar') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('admin-calendar') ? 'text-custom-orange' : '' }}">Calendar</span>
            </a>

        </li>

        <li>
            <a href="{{ route('assign-shift') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group 
       {{ request()->routeIs('assign-shift') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">

                <svg class="w-6 h-6 {{ request()->routeIs('assign-shift') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>

                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('assign-shift') ? 'text-custom-orange' : '' }}">
                    Shift Assignment
                </span>

                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
              {{ request()->routeIs('assign-shift') ? '' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>


        <li>
            <a href="{{ route('employee-dtr') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group 
        {{ request()->routeIs('employee-dtr') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('employee-dtr') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.512 8.72a2.46 2.46 0 0 1 3.479 0 2.461 2.461 0 0 1 0 3.479l-.004.005-1.094 1.08a.998.998 0 0 0-.194-.272l-3-3a1 1 0 0 0-.272-.193l1.085-1.1Zm-2.415 2.445L7.28 14.017a1 1 0 0 0-.289.702v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .703-.288l2.851-2.816a.995.995 0 0 1-.26-.189l-3-3a.998.998 0 0 1-.19-.26Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M7 3a1 1 0 0 1 1 1v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h1V4a1 1 0 0 1 1-1Zm10.67 8H19v8H5v-8h3.855l.53-.537a1 1 0 0 1 .87-.285c.097.015.233.13.277.087.045-.043-.073-.18-.09-.276a1 1 0 0 1 .274-.873l1.09-1.104a3.46 3.46 0 0 1 4.892 0l.001.002A3.461 3.461 0 0 1 17.67 11Z" clip-rule="evenodd" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('employee-dtr') ? 'text-custom-orange' : '' }}">Employee's DTR</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
            {{ request()->routeIs('employee-dtr') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('manage-account') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group 
        {{ request()->routeIs('manage-account') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('manage-account') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a16.405 16.405 0 0 1-5.092-5.804A16.694 16.694 0 0 1 5 6.666L12 4l7 2.667a16.695 16.695 0 0 1-1.908 7.529A16.406 16.406 0 0 1 12 20Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('manage-account') ? 'text-custom-orange' : '' }}">Manage Account</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
            {{ request()->routeIs('manage-account') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('employee-request') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg text-white group 
        {{ request()->routeIs('employee-request') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('employee-request') ? 'text-custom-orange' : 'text-gray-800 text-white group-hover:text-custom-orange' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('employee-request') ? 'text-custom-orange' : '' }}">Employee Request</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange 
            {{ request()->routeIs('employee-request') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}">
                </span>
            </a>
        </li>









        <!-- <form method="POST" action="{{ route('logout') }}">
            @csrf

            <nav :href="route('logout')"
                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                <nav>

                    <a href="#" class="">
                        <div x-show="open" class="flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group hover:text-custom-orange relative">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white group-hover:text-custom-orange" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Sign out</span> -->

        </div>
        </li>
        </ul>
        </div>
    </aside>

    <!--<div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
            </div> !-->
    </div>
    </div>
    </div>
    </div>



    <main class="p-4 md:ml-64 mt-16 md:mt-16">
        <div class="flex-col space-y-4">
            <!-- Main Content -->
            {{ $slot }}
        </div>
    </main>

    <script>
        // Toggle sidebar visibility
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('logo-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Toggle user menu visibility
        document.getElementById('user-menu-toggle').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdown-user');
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown menu when clicking outside
        window.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-user');
            const userMenuButton = document.getElementById('user-menu-toggle');
            if (!userMenuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>