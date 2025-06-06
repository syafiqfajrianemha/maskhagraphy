<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div>
                            {{-- <x-input-label for="image" :value="__('Image')" /> --}}
                            <img src="{{ asset('storage/files/images/' . $product->image) }}" alt="photo of {{ $product->image }}" class="img-thumbnail img-preview" width="100">
                            <input type="file" name="image" id="image" onchange="previewImage()" class="mt-1 block w-full file:py-1 file:px-2 file:rounded-full file:border-0 file:bg-violet-50 file:text-violet-700">
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" min="0" class="mt-1 block w-full" :value="$product->price" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $product->description }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center mt-5">
                            <x-primary-button>{{ __('Edit') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('js/imgpreview.js') }}"></script>
    @endpush
</x-app-layout>
