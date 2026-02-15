<footer class="bg-black text-gray-300 py-10 mt-auto">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 
                grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

        <!-- Logo and Description -->
        <div>
            <h2 class="text-2xl font-bold text-yellow-500">
                Orchid <span class="text-white">Ushers & Hospitality Agency</span>
            </h2>
            <p class="mt-4 text-gray-400 leading-relaxed">
                We are a premier ushering service dedicated to creating seamless, professional experiences at events of
                all sizes.
            </p>
            <div class="mt-4 flex space-x-4">
                <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- About Links -->
        <div>
            <h3 class="text-xl font-bold text-white">About</h3>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('orchid.aboutus') }}" class="hover:text-yellow-500">Vision</a></li>
                <li><a href="{{ route('orchid.aboutus') }}" class="hover:text-yellow-500">Mission</a></li>
                <li><a href="{{ route('orchid.aboutus') }}" class="hover:text-yellow-500">Core Values</a></li>
            </ul>
        </div>

        <!-- Connect Links -->
        <div>
            <h3 class="text-xl font-bold text-white">Connect</h3>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('orchid.contact') }}" class="hover:text-yellow-500">Contact Us</a></li>
                <li class="text-yellow-500">Kampala, Uganda</li>
                <li class="text-yellow-500">+256 771627311</li>
            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-800 mt-10 pt-4 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} All rights reserved | Maintained by <a href="mailto:guugaconsults@gmail.com" title="guugaconsults@gmail.com" class="hover:text-gray-400 hover:underline">Guuga Consults</a>
    </div>
</footer>
