<nav x-data="{ open: false }" class="bg-purple-900 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/orchid.jpg') }}" alt="Orchid Ushers" class="h-10 w-auto rounded-md">
                    <span class="text-xl font-bold text-white hidden md:block">Orchid Ushers</span>
                    <span class="text-xl font-bold text-white md:hidden">Ushers</span>
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8">
                @php
                    $active = 'text-yellow-400 font-semibold border-b-2 border-yellow-400 pb-1';
                    $inactive = 'text-white hover:text-yellow-300 transition';
                @endphp

                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? $active : $inactive }}">Home</a>
                <a href="{{ route('orchid.aboutus') }}" class="{{ request()->routeIs('orchid.aboutus') ? $active : $inactive }}">About Us</a>
                <a href="{{ route('orchid.events') }}" class="{{ request()->routeIs('orchid.events') ? $active : $inactive }}">Events</a>
                <a href="{{ route('orchid.gallery') }}" class="{{ request()->routeIs('orchid.gallery') ? $active : $inactive }}">Gallery</a>
                <a href="{{ route('orchid.testimonials') }}" class="{{ request()->routeIs('orchid.testimonials') ? $active : $inactive }}">Testimonials</a>
                <a href="{{ route('orchid.contact') }}" class="{{ request()->routeIs('orchid.contact') ? $active : $inactive }}">Contact</a>

                {{-- CTA --}}
                <a href="#" class="ml-4 px-4 py-2 border-2 border-purple-400 hover:border-purple-500 text-white hover:text-purple-500 font-bold py-2 px-4 rounded-lg">
                    Book Now
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="md:hidden bg-purple-900 border-t border-purple-700">
        <div class="px-4 py-4 space-y-2">
            @php
                $mobileActive = 'text-yellow-400 font-semibold';
                $mobileInactive = 'text-white hover:text-yellow-300';
            @endphp

            <a href="{{ route('home') }}" class="block {{ request()->routeIs('home') ? $mobileActive : $mobileInactive }}">Home</a>
            <a href="{{ route('orchid.aboutus') }}" class="block {{ request()->routeIs('orchid.aboutus') ? $mobileActive : $mobileInactive }}">About Us</a>
            <a href="{{ route('orchid.events') }}" class="block {{ request()->routeIs('orchid.events') ? $mobileActive : $mobileInactive }}">Events</a>
            <a href="{{ route('orchid.gallery') }}" class="block {{ request()->routeIs('orchid.gallery') ? $mobileActive : $mobileInactive }}">Gallery</a>
            <a href="{{ route('orchid.testimonials') }}" class="block {{ request()->routeIs('orchid.testimonials') ? $mobileActive : $mobileInactive }}">Testimonials</a>
            <a href="{{ route('orchid.contact') }}" class="block {{ request()->routeIs('orchid.contact') ? $mobileActive : $mobileInactive }}">Contact</a>
            <a href="#" class="block mt-3 text-center px-4 py-2 bg-yellow-500 text-black rounded-md">Book Now</a>
        </div>
    </div>
</nav>
