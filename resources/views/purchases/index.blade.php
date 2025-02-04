<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchase') }}
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
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Image</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">User Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Purchased On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchases as $purchase)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/files/images/' . $purchase->product->image) }}" alt="" width="50">
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $purchase->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($purchase->purchased_at)->translatedFormat('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="text-red-800 text-center p-6" colspan="6">There is no data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    @endpush
</x-app-layout>
