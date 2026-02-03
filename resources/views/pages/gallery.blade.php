@extends('layouts_front.app')

@section('content')
    <section class="py-10 sm:py-12 bg-gray-100">
        <div class="text-center mb-6 sm:mb-10">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-wide">
                Our Gallery
            </h2>
            <p class="text-gray-600 mt-2">
                Moments from weddings & corporate events we have proudly served
            </p>
        </div>

        <div class="container mx-auto px-4">

            {{-- Filter Tabs --}}
            <div class="flex justify-center gap-3 mb-8 flex-wrap">
                <button class="px-4 py-2 bg-black text-white rounded-full text-sm">
                    All
                </button>
                <button class="px-4 py-2 bg-white border rounded-full text-sm">
                    Weddings
                </button>
                <button class="px-4 py-2 bg-white border rounded-full text-sm">
                    Corporate
                </button>
            </div>

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($images as $image)
                    <div class="group relative overflow-hidden rounded-lg shadow bg-white">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $image->description ?? 'Ushering gallery image' }}"
                            class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">

                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                            <div class="p-4 text-white">
                                @if ($image->title)
                                    <h4 class="font-semibold text-sm">
                                        {{ $image->title }}
                                    </h4>
                                @endif
                                @if ($image->description)
                                    <p class="text-xs mt-1 text-gray-200">
                                        {{ $image->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        Gallery images coming soon.
                    </p>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $images->links() }}
            </div>

        </div>
    </section>
@endsection
