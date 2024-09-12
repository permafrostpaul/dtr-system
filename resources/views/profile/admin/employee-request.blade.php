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
    <div class="bg-body-blue min-h-screen flex flex-col items-center px-4">
        <!-- Search Bars and Headers -->
        <div class="relative w-full">
            <form action="{{ route('search.leave-requests') }}" method="GET" class="relative">
                <input
                    type="text"
                    name="query"
                    class="w-full p-4 rounded-full shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="Search..."
                    value="{{ request('query') }}">
                <button formaction="{{ route('search.leave-requests') }}" type="submit" class="absolute right-2 top-2 p-3 bg-orange-500 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M15 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </button>
            </form>
        </div>


        <!-- Pending, Accepted, and Declined Requests Containers -->
        <div class="flex flex-col md:flex-row justify-between items-center w-full mt-6 space-y-6 md:space-y-0 md:space-x-6">
            <!-- Pending Requests -->
            <div class="w-full max-w-2xl md:max-w-[24rem] bg-custom-blue p-6 rounded-lg shadow-lg border-4 border-custom-orange">
                <h2 class="text-yellow-500 font-semibold text-center mb-4">PENDING REQUESTS</h2>
                <div class="overflow-y-auto h-96">
                    @foreach ($pendingRequests as $leaveRequest)
                    <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md">
                        <p class="font-semibold">Leave Request from {{ $leaveRequest->user->firstname }} {{ $leaveRequest->user->lastname }}</p>
                        <p class="text-gray-600 text-sm text-right mt-2">Requested on {{ $leaveRequest->created_at->format('F d, Y') }}</p>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">{{ $leaveRequest->user->name }}</h3>
                            <p class="text-md text-custom-orange font-bold">EMP:{{ $leaveRequest->user->employeeid }}</p>
                            <p class="text-sm text-gray-700">LN {{ $leaveRequest->leave_number }}</p>
                            <p class="text-sm mt-2"><strong>Date From:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_from)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Date To:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_to)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Leave Duration:</strong> {{ $leaveRequest->duration }}</p>
                            <p class="text-sm"><strong>Type of Leave:</strong> {{ $leaveRequest->leave_type }}</p>
                            <p class="text-sm"><strong>Reason:</strong> {{ $leaveRequest->reason }}</p>
                            @php
                            $statusText = ucfirst($leaveRequest->status);
                            $statusClasses = [
                            'accepted' => 'text-green-500',
                            'pending' => 'text-yellow-500',
                            'rejected' => 'text-red-500',
                            ];
                            $statusClass = $statusClasses[$leaveRequest->status] ?? 'text-gray-500';
                            @endphp
                            <p class="text-sm mt-2"><strong>Status:</strong> <span class="{{ $statusClass }}">{{ $statusText }}</span></p>
                        </div>
                        <div class="mt-4 flex justify-end space-x-4">
                            <form action="{{ route('leave-request.accept', $leaveRequest->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" formaction="{{ route('leave-request.accept', $leaveRequest->id) }}" class="text-green-500 hover:text-green-600">Accept</button>
                            </form>
                            <form action="{{ route('leave-request.decline', $leaveRequest->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-600">Decline</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Accepted Requests -->
            <div class="w-full max-w-2xl md:max-w-[24rem] bg-custom-blue p-6 rounded-lg shadow-lg border-4 border-custom-orange">
                <h2 class="text-green-500 font-semibold text-center mb-4">ACCEPTED REQUESTS</h2>
                <div class="overflow-y-auto h-96">
                    @foreach ($acceptedRequests as $leaveRequest)
                    <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md">
                        <p class="font-semibold">Leave Request from {{ $leaveRequest->user->firstname }} {{ $leaveRequest->user->lastname }}</p>
                        <p class="text-gray-600 text-sm text-right mt-2">Requested on {{ $leaveRequest->created_at->format('F d, Y') }}</p>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">{{ $leaveRequest->user->name }}</h3>
                            <p class="text-md text-custom-orange font-bold">EMP:{{ $leaveRequest->user->employeeid }}</p>
                            <p class="text-md text-gray-700">LN {{ $leaveRequest->leave_number }}</p>
                            <p class="text-sm mt-2"><strong>Date From:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_from)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Date To:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_to)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Leave Duration:</strong> {{ $leaveRequest->duration }}</p>
                            <p class="text-sm"><strong>Type of Leave:</strong> {{ $leaveRequest->leave_type }}</p>
                            <p class="text-sm"><strong>Reason:</strong> {{ $leaveRequest->reason }}</p>
                            @php
                            $statusText = ucfirst($leaveRequest->status);
                            $statusClasses = [
                            'accepted' => 'text-green-500',
                            'pending' => 'text-yellow-500',
                            'declined' => 'text-red-500',
                            ];
                            $statusClass = $statusClasses[$leaveRequest->status] ?? 'text-gray-500';
                            @endphp
                            <p class="text-sm mt-2"><strong>Status:</strong> <span class="{{ $statusClass }}">{{ $statusText }}</span></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Declined Requests -->
            <div class="w-full max-w-2xl md:max-w-[24rem] bg-custom-blue p-6 rounded-lg shadow-lg border-4 border-custom-orange">
                <h2 class="text-red-500 font-semibold text-center mb-4">DECLINED REQUESTS</h2>
                <div class="overflow-y-auto h-96">
                    @foreach ($declinedRequests as $leaveRequest)
                    <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md">
                        <p class="font-semibold">Leave Request from {{ $leaveRequest->user->firstname }} {{ $leaveRequest->user->lastname }}</p>
                        <p class="text-gray-600 text-sm text-right mt-2">Requested on {{ $leaveRequest->created_at->format('F d, Y') }}</p>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">{{ $leaveRequest->user->name }}</h3>
                            <p class="text-md text-custom-orange font-bold">EMP:{{ $leaveRequest->user->employeeid }}</p>
                            <p class="text-md text-gray-700">LN {{ $leaveRequest->leave_number }}</p>
                            <p class="text-sm mt-2"><strong>Date From:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_from)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Date To:</strong> {{ \Carbon\Carbon::parse($leaveRequest->date_to)->format('F d, Y') }}</p>
                            <p class="text-sm"><strong>Leave Duration:</strong> {{ $leaveRequest->duration }}</p>
                            <p class="text-sm"><strong>Type of Leave:</strong> {{ $leaveRequest->leave_type }}</p>
                            <p class="text-sm"><strong>Reason:</strong> {{ $leaveRequest->reason }}</p>
                            @php
                            $statusText = ucfirst($leaveRequest->status);
                            $statusClasses = [
                            'accepted' => 'text-green-500',
                            'pending' => 'text-yellow-500',
                            'declined' => 'text-red-500',
                            ];
                            $statusClass = $statusClasses[$leaveRequest->status] ?? 'text-gray-500';
                            @endphp
                            <p class="text-sm mt-2"><strong>Status:</strong> <span class="{{ $statusClass }}">{{ $statusText }}</span></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>