@extends('layouts_front.app')
@section('css')
    <style>
        .group {
            backdrop-filter: blur(5px);
        }

        .group:hover {
            transition: all .5s ease;
        }
    </style>
@endsection
@section('content')
    <section class="py-14 bg-gradient-to-b from-gray-100 to-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    What Our Clients Say
                </h2>

                <p class="text-gray-600 mt-3 max-w-2xl mx-auto">
                    We are honored to have served families, organizations, and institutions.
                    Their words are our greatest testimony.
                </p>
            </div>

            {{-- Filter Tabs --}}
            <div class="flex justify-center gap-3 mb-10 flex-wrap relative border-b pb-3" id="testimonialTabs">

                @php
                    $eventTypes = [
                        'weddings' => 'Weddings',
                        'introductions' => 'Introductions',
                        'corporate' => 'Corporate Events',
                        'sports' => 'Sports Events',
                        'church' => 'Church Events',
                        'others' => 'Others',
                    ];
                @endphp

                <a href="{{ route('orchid.testimonials') }}"
                    class="testimonial-tab px-5 py-2 rounded-full text-sm font-semibold
{{ !request('event_type') ? 'bg-purple-900 text-white' : 'bg-white text-purple-900' }}">
                    All
                </a>

                @foreach ($eventTypes as $key => $label)
                    <a href="{{ route('orchid.testimonials', ['event_type' => $key]) }}"
                        class="testimonial-tab px-5 py-2 rounded-full text-sm font-semibold
{{ request('event_type') == $key ? 'bg-purple-900 text-white' : 'bg-white text-purple-900' }}">
                        {{ $label }}
                    </a>
                @endforeach

                <span id="testimonialUnderline"
                    class="absolute bottom-0 h-1 bg-purple-900 rounded transition-all duration-300"></span>

            </div>

            {{-- Testimonials Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

                @forelse($testimonials as $testimonial)
                    <div
                        class="group relative bg-white rounded-2xl p-8 shadow-md 
hover:shadow-2xl transition duration-500
transform hover:-translate-y-2">

                        {{-- Decorative glow --}}
                        <div
                            class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100
bg-gradient-to-br from-purple-50 to-transparent transition duration-500 pointer-events-none">
                        </div>

                        {{-- Quote Mark --}}
                        <div class="absolute -top-6 left-6 text-yellow-400 text-6xl font-serif opacity-80">
                            “
                        </div>

                        {{-- Message --}}
                        <div class="relative text-gray-700 italic leading-relaxed text-sm md:text-base">
                            {!! Str::limit($testimonial->message, 350) !!}
                        </div>

                        {{-- Rating --}}
                        @if ($testimonial->rating)
                            <div class="relative flex mt-6 space-x-1 text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118l-3.37-2.449a1 1 0 00-1.176 0l-3.37 2.449c-.784.57-1.838-.197-1.539-1.118l1.285-3.955z" />
                                    </svg>
                                @endfor
                            </div>
                        @endif

                        {{-- Client Footer --}}
                        <div class="mt-8 pt-6 border-t flex items-center gap-4 relative">

                            {{-- Avatar --}}
                            @if ($testimonial->client_photo)
                                <img src="{{ asset('storage/' . $testimonial->client_photo) }}"
                                    class="w-14 h-14 rounded-full object-cover ring-4 ring-purple-50">
                            @else
                                <div
                                    class="w-14 h-14 rounded-full bg-purple-100
flex items-center justify-center text-purple-700 font-bold text-lg">
                                    {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                </div>
                            @endif

                            {{-- Client Details --}}
                            <div class="space-y-1">

                                <h4 class="font-semibold text-gray-900">
                                    {{ $testimonial->client_name }}
                                </h4>

                                {{-- Phone Contact --}}
                                @if ($testimonial->phone_contact)
                                    <a href="tel:{{ $testimonial->phone_contact }}"
                                        class="text-sm text-purple-600 hover:underline flex items-center gap-1">

                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.962.725l.546 2.182a1 1 0 01-.27.95l-1.22 1.22a11.042 11.042 0 005.516 5.516l1.22-1.22a1 1 0 01.95-.27l2.182.546a1 1 0 01.725.962V17a1 1 0 01-1 1C7.163 18 2 12.837 2 6V3z" />
                                        </svg>

                                        {{ $testimonial->phone_contact }}
                                    </a>
                                @endif

                                @if ($testimonial->event_type)
                                    <p class="text-xs text-gray-400">
                                        {{ ucfirst($testimonial->event_type) }}
                                    </p>
                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full text-center py-16 text-gray-400">
                        No testimonials yet — be the first to share your experience.
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $testimonials->links() }}
            </div>

        </div>

    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            const $tabs = $('.testimonial-tab');
            const $underline = $('#testimonialUnderline');

            function moveUnderline($tab) {
                $underline.css({
                    width: $tab.outerWidth(),
                    left: $tab.position().left
                });
            }

            let activeTab = $tabs.filter(function() {
                return $(this).hasClass('bg-purple-900');
            }).first();

            moveUnderline(activeTab);

            $tabs.click(function(e) {
                e.preventDefault();
                moveUnderline($(this));
                window.location.href = $(this).attr('href');
            });

            $(window).resize(function() {
                moveUnderline(activeTab);
            });

        });
    </script>
@endsection
