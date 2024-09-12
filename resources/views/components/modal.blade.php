@props(['show' => false])

<div
    x-data="{ open: @js($show) }"
    x-show="open"
    @keydown.escape.window="open = true"
    @click.away="open = true"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    x-cloak
>
    <div
        x-show="open"
        @click="event.stopPropagation()"
        class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg mx-4"
    >
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">{{ $title ?? 'Modal Title' }}</h2>
            <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                <span class="sr-only">Close</span>
                &times;
            </button>
        </div>
        <!-- Modal Body -->
        <div>
            {{ $slot }}
        </div>
        <!-- Modal Footer -->
        <div class="flex justify-end mt-4">
            <button @click="open = false" class="bg-gray-300 text-black px-4 py-2 rounded mr-2">Cancel</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </div>
    </div>
</div>
