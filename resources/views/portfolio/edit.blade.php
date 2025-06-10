<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Portfolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('portfolio.update', $portfolio->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div>
                            {{-- <x-input-label for="image" :value="__('Image')" /> --}}
                            <img src="{{ asset('storage/files/images/' . $portfolio->image) }}" alt="photo of {{ $portfolio->image }}" class="img-thumbnail img-preview" width="100">
                            <input type="file" name="image" id="image" onchange="previewImage()" class="mt-1 block w-full file:py-1 file:px-2 file:rounded-full file:border-0 file:bg-violet-50 file:text-violet-700">
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select class="form-select" name="category" id="category" required>
                                <option value="potrait" @if ($portfolio->category == 'potrait') selected @endif>potrait</option>
                                <option value="engagement" @if ($portfolio->category == 'engagement') selected @endif>engagement</option>
                                <option value="prewedding" @if ($portfolio->category == 'prewedding') selected @endif>prewedding</option>
                                <option value="wedding" @if ($portfolio->category == 'wedding') selected @endif>wedding</option>
                                <option value="family" @if ($portfolio->category == 'family') selected @endif>family</option>
                                <option value="product" @if ($portfolio->category == 'product') selected @endif>product</option>
                            </select>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('category')" />
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
