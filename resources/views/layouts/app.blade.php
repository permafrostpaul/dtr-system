<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/Innovato_logo.png') }}" type="image/png">

    <title>{{ config('app.name', 'Laravel') }} - DTR System</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
    <!-- FullCalendar CSS -->

    <!-- FullCalendar JavaScript -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/main.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/daygrid.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/interaction.min.js'></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-body-blue flex justify-center items-center relative" x-data="{ sidebarOpen: false }">
    <!-- Sidebar Toggle Button for Small Screens -->
    <nav class="fixed top-0 z-50 w-full bg-custom-blue  border-b border-body-blue">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button id="sidebar-toggle" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-custom-orange focus:outline-none focus:ring-2 focus:ring-custom-orange dark:text-gray-400 dark:hover:bg-custom-orange dark:focus:ring-custom-orange">
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
                        <button id="user-menu-toggle" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false">
                            <span class="sr-only">Open user menu</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->


    <!-- <img src="{{ asset('/images/background.png') }}" alt="Background Image" class="max-w-full h-auto absolute inset-0 z-0 mx-auto">
    <div class="z-0 relative">  -->

    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-custom-blue border-b border-custom-gray sm:translate-x-0 bg-custom-blue" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 bg-custom-blue">
            <ul class="space-y-2 font-medium mb-4">
                <li>
                    <a href="#" class="flex items-center justify-between p-2 mb-4 text-gray-900 rounded-lg dark:text-white">
                        <div class="flex items-center mt-[-2rem]">
                            <!-- User icon -->
                            <svg class="w-[39px] h-[41px] text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd" />
                            </svg>

                            <!-- User name -->
                            <span class=" text-md font-semibold sm:text-md whitespace-nowrap dark:text-white">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </span>
                            <div x-data="{ open: false }" class="relative ">
                                <button @click="open = ! open" class="flex items-center">
                                    <svg class="w-[20px] h-[20px] text-custom-orange mr-[2rem] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 text-right w-32 bg-custom-blue z-30 rounded-lg shadow-lg">

                                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-custom-orange rounded-lg">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm">Help</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <nav :href="route('logout')"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <nav>
                                                <a href="#" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-custom-orange rounded-lg">
                                                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                                    </svg>

                                                    <span class="text-sm ml-1">Sign Out</span>
                                                </a>
                                </div>
                            </div>
                    </a>
        </div>

        <!-- Dropdown icon -->

        <a href="{{ route('dashboard') }}"
            class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group
   {{ request()->routeIs('dashboard') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">

            <!-- SVG Icon -->
            <svg class="w-6 h-6 {{ request()->routeIs('dashboard') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24" height="24"
                fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2"
                    d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
            </svg>

            <!-- Text -->
            <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('dashboard') ? 'text-custom-orange' : '' }}">Dashboard</span>

            <!-- Right Border Line -->
            <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange {{ request()->routeIs('dashboard') ? '' : 'opacity-0 group-hover:opacity-100' }}"></span>
        </a>





        </li>
        <li>
            <a href="{{ route('profile.edit') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group {{ request()->routeIs('profile.edit') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('profile.edit') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('profile.edit') ? 'text-custom-orange' : ''}}">Profile</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange {{ request()->routeIs('profile.edit') ? '' : 'opacity-0 group-hover:opacity-100' }}"></span>
            </a>
        </li>

        <li>
            <a href="{{ route('attendance') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group {{ request()->routeIs('attendance') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('attendance') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('attendance') ? 'text-custom-orange' : '' }}">Attendance Tracker</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange {{ request()->routeIs('attendance') ? '' : 'opacity-0 group-hover:opacity-100' }}"></span>
            </a>
        </li>

        <li>
            <a href="{{ route('request-leave') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group {{ request()->routeIs('request-leave') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('request-leave') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('request-leave') ? 'text-custom-orange' : '' }}">Request Leave</span>
                <span class="absolute inset-y-0 right-0 w-1 bg-custom-orange {{ request()->routeIs('request-leave') ? '' : 'opacity-0 group-hover:opacity-100' }}"></span>
            </a>
        </li>

        <li>
            <a href="{{ route('calendar') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group {{ request()->routeIs('calendar') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('calendar') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('calendar') ? 'text-custom-orange' : '' }}">Calendar</span>
            </a>

        </li>

        <li>
            <a href="{{ route('notifications') }}" class="relative flex items-center p-2 mb-4 text-gray-900 rounded-lg dark:text-white group {{ request()->routeIs('notifications') ? 'text-custom-orange' : 'hover:text-custom-orange' }}">
                <svg class="w-6 h-6 {{ request()->routeIs('notifications') ? 'text-custom-orange' : 'text-gray-800 dark:text-white group-hover:text-custom-orange' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('notifications') ? 'text-custom-orange' : '' }}"">Notification</span>
                        <span class=" absolute inset-y-0 right-0 w-1 bg-custom-orange {{ request()->routeIs('notifications') ? '' : 'opacity-0 group-hover:opacity-100' }}"></span>
            </a>
        </li>

    </aside>

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