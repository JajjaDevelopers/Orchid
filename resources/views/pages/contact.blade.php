@extends('layouts_front.app')

@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        /* Premium focus glow */
        input:focus,
        select:focus,
        #contactEditor:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.25);
            transition: all .3s ease;
        }

        /* Quill editor */
        #contactEditor {
            min-height: 180px;
        }

        /* Submit button animation */
        .contact-submit-btn {
            transition: all .3s ease;
        }

        .contact-submit-btn:hover {
            transform: translateY(-2px);
        }

        /* Spinner animation */
        .spinner {
            display: none;
        }
    </style>
@endsection

@section('content')
    <section class="py-12 bg-gray-100">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">

                <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">
                    Contact Us
                </h2>

                <p class="text-gray-600 text-center mb-8">
                    We would love to hear from you. Reach out anytime.
                </p>

                {{-- Alerts --}}
                <div id="formAlert"></div>

                <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <input type="text" name="name" id="name" placeholder="Your Name *"
                            class="w-full border rounded-lg p-3">
                        <span id="name-error" class="text-red-500 text-sm"></span>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <input type="email" name="email" id="email" placeholder="Your Email *"
                            class="w-full border rounded-lg p-3">
                        <span id="email-error" class="text-red-500 text-sm"></span>
                    </div>

                    {{-- Phone (No country code) --}}
                    <div class="mb-4">
                        <input type="tel" name="phone" placeholder="Phone Number"
                            class="w-full border rounded-lg p-3">
                    </div>

                    {{-- Subject --}}
                    <div class="mb-4">
                        <input type="text" name="subject" placeholder="Message Subject"
                            class="w-full border rounded-lg p-3">
                    </div>

                    {{-- Rich Text Message --}}
                    <div class="mb-4">
                        <label class="font-semibold mb-2 block">Message</label>

                        <div id="contactEditor" class="bg-white border rounded-lg"></div>
                        <input type="hidden" name="message" id="message">

                        <div class="text-right text-sm text-gray-500 mt-1">
                            Characters: <span id="charCount">0</span>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="text-center">

                        <button type="submit"
                            class="contact-submit-btn w-full bg-purple-800 hover:bg-purple-900
text-white px-6 py-3 rounded-md font-semibold">

                            <span class="btnText">Send Message</span>

                            <span class="spinner ml-2">
                                <span class="animate-spin inline-block">⟳</span>
                            </span>

                        </button>

                    </div>

                </form>

            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            /* Rich Text Editor */
            var quill = new Quill('#contactEditor', {
                theme: 'snow',
                placeholder: 'Write your message...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['link']
                    ]
                }
            });

            /* Character counter */
            quill.on('text-change', function() {
                let text = quill.getText().trim();
                $('#charCount').text(text.length);
            });

            /* Form submit */
            $('#contactForm').on('submit', function(e) {

                e.preventDefault();

                $('#message').val(quill.root.innerHTML);

                let form = $(this);
                let btn = $('.contact-submit-btn');

                btn.prop('disabled', true);
                $('.spinner').show();

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),

                    success: function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            text: 'We will respond shortly',
                            confirmButtonColor: '#6d28d9'
                        });

                        form.trigger('reset');
                        quill.setText('');
                        $('#charCount').text('0');

                    },

                    error: function(xhr) {

                        let errors = xhr.responseJSON.errors;

                        $('.text-red-500').text('');

                        for (let field in errors) {
                            $(`#${field}-error`).text(errors[field][0]);
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops',
                            text: 'Something went wrong'
                        });

                    },

                    complete: function() {
                        btn.prop('disabled', false);
                        $('.spinner').hide();
                    }

                });

            });

        });
    </script>
@endsection
