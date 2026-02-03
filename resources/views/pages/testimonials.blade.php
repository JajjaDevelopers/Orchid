@extends('layouts_front.app')

@section('content')
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">
                    What Our Clients Say
                </h2>
                <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
                    We are honored to have served families, organizations, and institutions.
                    Here is what some of our clients had to say.
                </p>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($testimonials as $testimonial)
                    <div class="bg-white rounded-lg shadow p-6 relative flex flex-col">

                        {{-- Quote Icon --}}
                        <div class="absolute -top-4 left-6 text-yellow-500 text-4xl leading-none">
                            “
                        </div>

                        {{-- Message --}}
                        <p class="text-gray-700 italic leading-relaxed mt-4 flex-grow">
                            {{ $testimonial->message }}
                        </p>

                        {{-- Rating --}}
                        @if ($testimonial->rating)
                            <div class="flex items-center mt-4 space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.449a1 1 0 00-1.176 0l-3.37 2.449c-.784.57-1.838-.197-1.539-1.118l1.285-3.955a1 1 0 00-.364-1.118L2.025 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.951-.69l1.286-3.955z" />
                                    </svg>
                                @endfor
                            </div>
                        @endif

                        {{-- Client Info --}}
                        <div class="mt-6 border-t pt-4 flex items-center gap-4">

                            {{-- Client Photo --}}
                            @if ($testimonial->client_photo)
                                <img src="{{ asset('storage/' . $testimonial->client_photo) }}"
                                    alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div
                                    class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold">
                                    {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                </div>
                            @endif

                            {{-- Name & Event --}}
                            <div>
                                <h4 class="font-semibold text-gray-900">
                                    {{ $testimonial->client_name }}
                                </h4>

                                @if ($testimonial->event_type)
                                    <p class="text-sm text-gray-500">
                                        {{ $testimonial->event_type }}
                                    </p>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        Testimonials will appear here soon.
                    </p>
                @endforelse

            </div>

        </div>
    </section>
@endsection
