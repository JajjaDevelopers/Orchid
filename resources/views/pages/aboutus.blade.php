@extends('layouts_front.app')
@section('content')
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
        <!-- Hero Section -->
        <section class="text-center py-12 md:py-12 bg-gradient-to-r from-purple-500 to-purple-600 text-white">
            <div class="max-w-6xl mx-auto px-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-4 md:mb-6">
                    About Our Ushering Service
                </h1>
                <p class="text-lg md:text-xl text-purple-100">
                    Delivering excellence in event management and guest services since our founding
                </p>
            </div>
        </section>


        <!-- Introduction Section -->
        <section class="py-8 md:py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-8">
                    We are a premier ushering service dedicated to creating seamless, professional experiences at events of
                    all sizes.
                    From intimate gatherings to large-scale conferences and weddings, our team ensures every guest feels
                    welcomed and valued.
                </p>
            </div>
        </section>

        <!-- Mission, Vision, Values Section -->
        <section class="py-10 md:py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

                    <!-- Mission -->
                    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4 md:mb-6">
                            <svg class="w-6 h-6 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            To provide exceptional ushering and event coordination services that enhance guest experiences
                            and contribute to the success of every event we serve.
                        </p>
                    </div>

                    <!-- Vision -->
                    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4 md:mb-6">
                            <svg class="w-6 h-6 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            To be the most trusted and innovative ushering service, recognized for our professionalism,
                            reliability, and commitment to creating memorable event experiences.
                        </p>
                    </div>

                    <!-- Core Values -->
                    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4 md:mb-6">
                            <svg class="w-6 h-6 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-4">Core Values</h3>
                        <ul class="text-sm md:text-base text-gray-600 space-y-2">
                            <li class="flex items-start">
                                <span class="text-purple-900 mr-2">•</span>
                                <span><strong>Professionalism:</strong> Excellence in every interaction</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-900 mr-2">•</span>
                                <span><strong>Integrity:</strong> Honest and ethical practices</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-900 mr-2">•</span>
                                <span><strong>Reliability:</strong> Consistent, dependable service</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-10 md:py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-2xl md:text-4xl font-bold text-center mb-8 md:mb-12 text-gray-900">Why Choose Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

                    @foreach ([
            'Trained Professionals' => 'Our team is thoroughly trained in hospitality, event management, and guest relations.',
            'Extensive Experience' => 'With years of experience, we\'ve successfully managed events of varying scales and complexities.',
            'Customized Solutions' => 'We tailor our services to meet the unique needs and requirements of your event.',
            'Attention to Detail' => 'From coordination to execution, we ensure every detail is handled with precision and care.',
        ] as $title => $desc)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-md bg-purple-100">
                                    <svg class="h-6 w-6 text-purple-900" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base md:text-lg font-semibold text-gray-900">{{ $title }}</h3>
                                <p class="mt-2 text-sm md:text-base text-gray-600">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </section>
@endsection
