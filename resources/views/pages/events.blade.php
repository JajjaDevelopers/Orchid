@extends('layouts_front.app')

@section('content')
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    Events We Handle
                </h2>
                <p class="mt-3 text-gray-600 max-w-3xl mx-auto">
                    From intimate cultural ceremonies to large-scale corporate and public events,
                    we provide professional ushering services marked by grace, order, and excellence.
                </p>
            </div>

            {{-- Events Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Traditional Ceremonies --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-ring"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Kwanjula / Kuhingira
                    </h3>
                    <p class="text-gray-600">
                        We honor tradition with grace—ensuring guests are well received,
                        guided, and seated with respect befitting cultural ceremonies.
                    </p>
                </div>

                {{-- Weddings --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Weddings
                    </h3>
                    <p class="text-gray-600">
                        From church aisles to reception halls, our ushers ensure seamless
                        coordination, elegance, and calm on your special day.
                    </p>
                </div>

                {{-- Corporate Events --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Corporate & Conferences
                    </h3>
                    <p class="text-gray-600">
                        Professional guest handling for meetings, launches, summits, and
                        conferences—first impressions matter.
                    </p>
                </div>

                {{-- Sports --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Sports Events
                    </h3>
                    <p class="text-gray-600">
                        Crowd guidance, VIP seating coordination, and orderly guest flow
                        for tournaments and sports functions.
                    </p>
                </div>

                {{-- Religious --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-church"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Religious Gatherings
                    </h3>
                    <p class="text-gray-600">
                        Ushering services for church services, conventions, crusades,
                        and faith-based ceremonies.
                    </p>
                </div>

                {{-- Private Functions --}}
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <div class="text-purple-900 text-4xl mb-4">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">
                        Private & Social Events
                    </h3>
                    <p class="text-gray-600">
                        Birthdays, anniversaries, graduations, and private celebrations
                        handled with warmth and discretion.
                    </p>
                </div>

            </div>

            {{-- Call to Action --}}
            <div class="mt-16 text-center">
                <p class="text-gray-700 mb-4">
                    Have an upcoming event? Let us handle the details with professionalism and care.
                </p>
                <a href="{{ route('orchid.contact') }}"
                    class="inline-block bg-purple-800 text-white px-6 py-3 rounded-md font-semibold hover:bg-purple-900 transition">
                    Talk to Us
                </a>
            </div>

        </div>
    </section>
@endsection
