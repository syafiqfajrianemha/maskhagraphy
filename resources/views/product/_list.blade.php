<table class="min-w-full bg-white border border-gray-200 mt-3">
    <thead>
        <tr class="w-full bg-gray-100 border-b">
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">No</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Image</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">File Name</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Price</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Description</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-700">{{ ++$no }}</td>
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/files/images/' . $product->image) }}" alt="" width="50">
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->image }}</td>
                <td class="px-6 py-4 text-sm text-gray-700 {{ $product->status === 'available' ? 'text-blue-600' : 'text-red-600' }}">{{ $product->status }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">Rp. {{ number_format($product->price, 0, '.', '.') }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->description === null ? '-' : $product->description }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">
                    <x-primary-href :href="route('product.edit', $product->id)" class="mb-2">
                        {{ __('Edit') }}
                    </x-primary-href>
                    @if ($product->status === 'available')
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr class="border-b hover:bg-gray-50">
                <td class="text-red-800 text-center p-6" colspan="6">There is no data.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $products->links() }}
</div>
