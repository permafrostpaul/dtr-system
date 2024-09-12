<x-admin-layout>
    @if (session('status'))
    <div id="notification" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-custom-orange text-white px-8 py-4 rounded-md shadow-lg relative max-w-md mx-auto">
            <button type="button" onclick="hideNotification()" class="absolute top-2 right-2 text-white">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
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

    <div class="bg-body-blue min-h-screen flex flex-col items-center">
        <!-- Container for Admin and Pending Accounts -->
        <div class="w-full max-w-7xl mx-auto flex flex-col md:flex-row items-center md:items-stretch justify-center md:justify-between space-y-6 md:space-y-0 md:space-x-6 mt-10 px-4">

            <!-- Admin Accounts Section -->
            <div class="flex-1 bg-custom-blue rounded-lg shadow-lg p-6 flex flex-col space-y-4 w-full md:w-96 max-w-[24rem]">
                <h2 class="text-white font-semibold text-center mb-4">ADMIN ACCOUNTS</h2>

                <!-- Admin Search Bar -->
                <div class="relative w-full">
                    <form action="{{ route('search.admin.accounts') }}" method="GET" class="relative">
                        <input
                            type="text"
                            name="query"
                            class="w-full p-4 rounded-full shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            placeholder="Search..."
                            value="">
                        <button formaction="{{ route('search.admin.accounts') }}" type="submit" class="absolute right-2 top-2 p-3 bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M15 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                        </button>
                    </form>
                </div>


                <!-- Admin Accounts List -->
                <div class="flex-1 overflow-y-auto max-h-96 w-full">
                    @foreach ($admins as $admin)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-4">
                        <div class="text-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-semibold">{{ $admin->firstname }} {{ $admin->lastname }}</h2>
                            <p class="text-sm text-gray-500">{{ $admin->email }}</p>
                            <p class="text-md text-orange-500 font-semibold">{{ $admin->role }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Add Admin Button -->

                <div class="flex justify-center items-center py-4">
                    <a href="{{ route('admin-signup') }}" class="bg-orange-600 text-white px-4 py-2 rounded inline-flex items-center space-x-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                        </svg>
                        <span>Add Admin</span>
                    </a>
                </div>

            </div>

            <!-- Pending Accounts Section -->
            <div class="flex-1 bg-custom-blue rounded-lg shadow-lg p-6 flex flex-col space-y-4 w-full md:w-96 max-w-[24rem]">
                <h2 class="text-white font-semibold text-center mb-4">PENDING ACCOUNTS</h2>

                <!-- Pending Accounts Search Bar -->
                <div class="relative w-full">
                    <form action="{{ route('search.pending.accounts') }}" method="GET" class="relative">
                        <input
                            type="text"
                            name="query"
                            class="w-full p-4 rounded-full shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            placeholder="Search..."
                            value=" ">
                        <button formaction="{{ route('search.pending.accounts') }}" type="submit" class="absolute right-2 top-2 p-3 bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M15 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Pending Accounts List -->
                <div class="flex-1 overflow-y-auto max-h-96 w-full">
                    @foreach ($pendingUsers as $user)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-4">
                        <div class="text-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-semibold">{{ $user->firstname }} {{ $user->lastname }}</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div class="text-center mt-4 flex justify-center space-x-2">
                            <form action="{{ route('admin.activate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Activate</button>
                            </form>
                            <form action="{{ route('admin.deactivate', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Deactivate</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>