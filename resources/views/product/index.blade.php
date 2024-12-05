<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-primary-href :href="route('product.create')">
                        {{ __('Add Product') }}
                    </x-primary-href>

                    <table class="min-w-full bg-white border border-gray-200 mt-3">
                        <thead>
                            <tr class="w-full bg-gray-100 border-b">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">No</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Image</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">File Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/files/images/' . $product->image) }}" alt="" width="50">
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $product->image }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Rp. {{ number_format($product->price, 0, '.', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $product->description }}</td>
                                    {{-- <td class="px-6 py-4 text-sm text-gray-700">
                                        <x-primary-href :href="route('product.edit', $product->id)" class="mb-2">
                                            {{ __('Edit') }}
                                        </x-primary-href>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="form-delete"">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">Delete</button>
                                        </form>
                                    </td> --}}
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
</x-app-layout>
