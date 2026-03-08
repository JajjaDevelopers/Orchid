@extends('layouts_front.app')

@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <style>
        /* Smooth focus highlight for inputs, selects, and Quill editor */
        input:focus,
        select:focus,
        #editor:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
            transition: all .3s ease;
        }

        /* Quill editor height */
        #editor {
            min-height: 160px;
        }

        @media (max-width: 768px) {
            #editor {
                min-height: 200px;
            }
        }

        /* Star rating styles */
        .star {
            font-size: 32px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.selected,
        .star:hover,
        .star.hovered {
            color: #FBBF24;
            /* Tailwind yellow-400 */
        }

        /* Elite submit button hover animation */
        .submit-btn {
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    <section class="py-12 bg-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg rounded-lg p-5 md:p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Share Your Experience
                </h2>

                <p class="text-gray-600 mb-6">
                    We would love to hear about your experience with
                    <strong>Orchid Ushers & Hospitality Agency</strong>.
                    Your feedback helps us improve and serve others better.
                </p>

                {{-- SUCCESS ALERT --}}
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded text-center animate-bounce">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- ERROR ALERT --}}
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded text-center">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $eventTypes = [
                        'weddings' => 'Weddings',
                        'introductions' => 'Introductions (Kwanjula/Kuhingira)',
                        'corporate' => 'Corporate Events',
                        'sports' => 'Sports Events',
                        'church' => 'Church Events',
                        'others' => 'Others',
                    ];
                @endphp

                <form action="{{ route('orchid.testimonials.store.public') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- IMPORTANT: TOKEN --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Client Name --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Your Name *</label>
                        <input type="text" name="client_name" value="{{ old('client_name') }}" required
                            class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-yellow-400">
                    </div>

                    {{-- Phone Contact --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Phone Contact (Optional)</label>
                        <input type="tel" name="phone_contact" value="{{ old('phone_contact') }}"
                            placeholder="+256 7XXXXXXXX"
                            class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-yellow-400">
                    </div>

                    {{-- Event Type --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Event Type</label>
                        <select name="event_type"
                            class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-yellow-400">
                            @foreach ($eventTypes as $key => $value)
                                <option value="{{ $key }}" {{ old('event_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Photo Upload --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Upload Photo (Optional)</label>
                        <input type="file" name="client_photo" accept="image/*"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    {{-- Message (Rich Text) --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Your Testimonial *</label>
                        <div id="editor" class="bg-white border rounded-lg"></div>
                        <input type="hidden" name="message" id="message">
                    </div>

                    {{-- Clickable Star Rating --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Your Rating(It Matters a lot!)</label>
                        <div class="flex space-x-2 text-3xl" id="ratingStars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star text-gray-300" data-value="{{ $i }}">★</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" value="5" required>
                    </div>

                    {{-- Submit --}}
                    <div class="text-center">
                        <button type="submit"
                            class="inline-block w-full md:w-auto bg-purple-800 text-white 
                                px-6 md:px-8 py-3 md:py-4 rounded-md font-semibold 
                                hover:bg-purple-900 transition shadow-lg submit-btn">

                            Submit Testimonial ✨

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // Quill rich text editor
            var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Write your experience with Orchid Ushers...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link']
                    ]
                }
            });

            // Submit form with Quill content
            $('form').on('submit', function() {
                $('#message').val(quill.root.innerHTML);
            });

            // Clickable star rating
            $('#ratingStars .star').on('mouseenter', function() {
                let value = $(this).data('value');
                $('#ratingStars .star').each(function() {
                    $(this).toggleClass('hovered', $(this).data('value') <= value);
                });
            }).on('mouseleave', function() {
                $('#ratingStars .star').removeClass('hovered');
            }).on('click', function() {
                let value = $(this).data('value');
                $('#ratingValue').val(value);
                $('#ratingStars .star').each(function() {
                    $(this).toggleClass('selected', $(this).data('value') <= value);
                    $(this).removeClass('hovered');
                });
            });

        });
    </script>
@endsection
