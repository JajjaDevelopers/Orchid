@extends('layouts_front.app')

@section('content')
    <section class="py-10 sm:py-12 bg-gray-100">
        <div class="text-center mb-6 sm:mb-10 px-4">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-wide">
                Our Gallery
            </h2>
            <p class="text-gray-600 mt-2">
                Moments from weddings, introductions, corporate events and many others we have proudly served
            </p>
        </div>

        <div class="container mx-auto px-4">

            {{-- Filter Tabs with sliding underline --}}
            <div class="flex justify-center gap-3 mb-8 flex-wrap relative border-b border-gray-300 pb-2" id="categoryTabs">

                {{-- "All" button --}}
                <a href="{{ route('orchid.gallery') }}"
                    class="category-tab px-4 py-2 rounded-full text-sm font-medium
               {{ request()->has('category') ? 'text-purple-900 bg-white' : 'text-white bg-purple-900' }}">
                    All
                </a>

                {{-- Dynamic category buttons --}}
                @foreach ($categories as $key => $label)
                    <a href="{{ route('orchid.gallery', ['category' => $key]) }}"
                        class="category-tab px-4 py-2 rounded-full text-sm font-medium
                   {{ request('category') == $key ? 'text-white bg-purple-900' : 'text-purple-900 bg-white' }}">
                        {{ $label }}
                    </a>
                @endforeach

                {{-- Sliding underline --}}
                <span id="categoryUnderline"
                    class="absolute bottom-0 h-1 bg-purple-900 rounded transition-all duration-300"></span>
            </div>

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($images as $index => $image)
                    <div class="group relative overflow-hidden rounded-lg shadow bg-white">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $image->description ?? 'Ushering gallery image' }}"
                            class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500 gallery-item"
                            data-index="{{ $index }}" data-title="{{ strip_tags($image->title) }}"
                            data-desc="{{ strip_tags($image->description) }}"
                            data-src="{{ asset('storage/' . $image->image_path) }}">
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        No Gallery images uploaded yet.
                    </p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $images->links() }}
            </div>
        </div>
    </section>

    {{-- Lightbox Modal --}}
    <div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center px-2">
        <!-- Close & Nav Buttons -->
        <button id="lightboxClose"
            class="absolute top-4 right-4 text-white text-3xl font-bold focus:outline-none">&times;</button>
        <button id="prevImage"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-4xl font-bold focus:outline-none">&lsaquo;</button>
        <button id="nextImage"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-4xl font-bold focus:outline-none">&rsaquo;</button>

        <!-- Image Container -->
        <div class="flex flex-col items-center justify-center max-w-4xl mx-4 text-center">
            <img id="lightboxImage" src="" alt=""
                class="max-w-full max-h-[80vh] object-contain rounded shadow-lg transition-transform duration-300">
            <h4 id="lightboxTitle" class="text-white font-semibold text-lg mt-2"></h4>
            <p id="lightboxDesc" class="text-gray-300 text-sm mt-1"></p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // --- Lightbox Logic ---
            let galleryItems = $('.gallery-item');
            let currentIndex = 0;

            function showLightbox(index) {
                let item = $(galleryItems[index]);
                currentIndex = index;
                $('#lightboxImage').fadeOut(200, function() {
                    $(this).attr('src', item.data('src')).fadeIn(300);
                    $('#lightboxTitle').text(item.data('title'));
                    $('#lightboxDesc').text(item.data('desc'));
                });
                $('#lightboxModal').fadeIn();
            }

            function closeLightbox() {
                $('#lightboxModal').fadeOut();
                $('#lightboxImage').attr('src', '');
                $('#lightboxTitle').text('');
                $('#lightboxDesc').text('');
            }

            function showPrev() {
                let prevIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
                showLightbox(prevIndex);
            }

            function showNext() {
                let nextIndex = (currentIndex + 1) % galleryItems.length;
                showLightbox(nextIndex);
            }

            galleryItems.click(function() {
                let index = $(this).data('index');
                showLightbox(index);
            });

            $('#lightboxClose').click(closeLightbox);
            $('#prevImage').click(showPrev);
            $('#nextImage').click(showNext);

            $(document).keyup(function(e) {
                if (e.key === "Escape") closeLightbox();
                if (e.key === "ArrowLeft") showPrev();
                if (e.key === "ArrowRight") showNext();
            });

            $('#lightboxModal').click(function(e) {
                if ($(e.target).is('#lightboxModal')) closeLightbox();
            });

            // --- Sliding underline for category tabs ---
            const $tabs = $('.category-tab');
            const $underline = $('#categoryUnderline');

            function moveUnderline($activeTab) {
                $underline.css({
                    width: $activeTab.outerWidth() + 'px',
                    left: $activeTab.position().left + 'px'
                });
            }

            // Set initial underline position
            let $activeTab = $tabs.filter(function() {
                return $(this).hasClass('bg-purple-900') || $(this).hasClass('text-white');
            }).first();
            moveUnderline($activeTab);

            // Animate on click
            $tabs.click(function(e) {
                e.preventDefault();
                moveUnderline($(this));
                window.location.href = $(this).attr('href'); // navigate
            });

            // Responsive handling on window resize
            $(window).resize(function() {
                moveUnderline($tabs.filter(function() {
                    return $(this).hasClass('bg-purple-900') || $(this).hasClass('text-white');
                }).first());
            });
        });
    </script>
@endsection
