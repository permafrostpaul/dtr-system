<x-app-layout>
    <div class="relative p-4 bg-custom-orange rounded-lg mt-8 shadow-lg w-full max-w-md mx-auto overflow-hidden">
        <!-- Background Orange Box -->
        <div class="absolute inset-0 -z-10 bg-custom-orange rounded-lg"></div>

        <!-- Notifications Container -->
        <div class="relative bg-custom-blue p-6 rounded-lg shadow-lg h-full overflow-y-auto">
            <h2 class="text-white text-2xl font-semibold mb-4">NOTIFICATIONS</h2>

            @forelse($notifications as $notification)
                <div class="bg-custom-blue p-4 mb-4 rounded-lg">
                    <p class="text-white">{{ $notification->data['message'] }}</p>
                    <p class="text-gray-300 text-sm text-right mt-2">{{ $notification->created_at->format('F d, Y h:i A') }}</p> <!-- Showing the time -->
                    <hr class="my-2 border-gray-500">
                </div>
            @empty
                <p class="text-gray-300">No notifications available.</p>
            @endforelse
        </div>
    </div>  
</x-app-layout>
