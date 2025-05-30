<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full bg-white border border-gray-200 mt-3">
                        <thead>
                            <tr class="w-full bg-gray-100 border-b">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">No</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Service</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">User Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">WhatsApp</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Time</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Payment</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Rejected Note</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->service->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->phone }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                    @if ($booking->status === 'waiting')
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="bg-yellow-100 py-1 px-2 rounded-md">Waiting</span>
                                    </td>
                                    @elseif ($booking->status === 'approved')
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="bg-green-100 py-1 px-2 rounded-md">Approved</span>
                                    </td>
                                    @elseif ($booking->status === 'rejected')
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="bg-red-100 py-1 px-2 rounded-md">Rejected</span>
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->payment }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->status === 'rejected' ? $booking->note : '-' }}</td>
                                    @if ($booking->status === 'waiting')
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="form-approved">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer mb-2">Approve</button>
                                        </form>
                                        <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="form-rejected">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <input type="hidden" name="rejected_note" class="rejected-note">
                                            <button type="submit" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">Reject</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="text-red-800 text-center p-6" colspan="8">There is no data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 600,
                    events: "{{ route('booking.events') }}",
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
                });

                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
