@extends('layouts_front.app')

@section('content')
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold">Contact Us</h2>
                <p class="text-gray-600 mt-2">We would love to hear from you. Feel free to reach out!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <form action="{{ route('contact.store') }}" method="POST" id='contactForm'>
                        @csrf
                        <div class="mb-4">
                            <input type="text" id="name" name="name" placeholder="Your Name"
                                class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <span id="name-error" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                        <div class="mb-4">
                            <input type="email" id="email" name="email" placeholder="Your Email"
                                class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <span id="email-error" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                        <div class="mb-4 flex flex-col sm:flex-row gap-2">
                            <div class="relative w-full sm:w-32">
                                <select id="country_code" name="country_code"
                                    class="w-full border-gray-300 rounded-lg p-3 h-12 focus:ring-2 focus:ring-yellow-500 focus:border-transparent appearance-none"></select>
                            </div>
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number"
                                class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <span id="phone-error" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                        <div class="mb-4">
                            <input type="text" id="subject" name="subject" placeholder="Message Subject"
                                class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <span id="subject-error" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                        <div class="mb-4">
                            <textarea rows="5" id="message" name="message" placeholder="Your Message"
                                class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent"></textarea>
                            <span id="message-error" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                        <button type="submit"
                            class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 sendMessage transition duration-300 w-full sm:w-auto">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Map Details -->
                <div class="rounded-lg overflow-hidden shadow-lg h-72 sm:h-[400px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!m12!1m3!1d3989.7411236321736!2d32.610820474353105!3d0.35641926396473245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbbd180e2110d%3A0xe1bd4a13e28ecaae!2sPetra%20Reformed%20Baptist%20Church!5e0!3m2!1sen!2sug!4v1740000841265!5m2!1sen!2sug"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-full">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container { width: 100% !important; }
        .select2-selection__rendered { 
            line-height: 34px !important; 
            padding-left: 36px !important; 
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        .select2-selection { 
            height: 48px !important; 
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
            background: white;
        }
        .select2-selection__arrow { 
            height: 46px !important; 
            right: 8px !important;
        }
        .flag-icon { 
            width: 20px; 
            height: 14px; 
            margin-right: 8px; 
            vertical-align: middle;
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
        }
        .select2-dropdown { 
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .select2-results__option { 
            padding: 8px 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #4b5563;
        }

        @media (max-width: 640px) {
            .select2-container { max-width: 100%; }
            .select2-selection { height: 44px !important; }
            .select2-selection__rendered { line-height: 30px !important; }
            .select2-selection__arrow { height: 42px !important; }
            .flex-col { gap: 0.5rem; }
            .w-32 { width: 100% !important; }
            iframe { height: 300px; }
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const countryCodes = [
                { id: '+256', text: 'Uganda (+256)', iso: 'ug' },
                { id: '+1', text: 'United States (+1)', iso: 'us' },
                { id: '+44', text: 'United Kingdom (+44)', iso: 'gb' },
                { id: '+254', text: 'Kenya (+254)', iso: 'ke' },
                { id: '+234', text: 'Nigeria (+234)', iso: 'ng' },
                { id: '+91', text: 'India (+91)', iso: 'in' },
            ];

            $('#country_code').select2({
                data: countryCodes,
                placeholder: "Code",
                allowClear: false,
                dropdownParent: $('#contactForm'),
                minimumResultsForSearch: 1,
                width: '100%',
                templateResult: formatCountryResult,
                templateSelection: formatCountrySelection
            });

            function formatCountryResult(country) {
                if (!country.id) { return country.text; }
                return $(
                    '<span><img src="https://flagcdn.com/w20/' + country.iso + '.png" class="flag-icon" /> ' + country.text + '</span>'
                );
            }

            function formatCountrySelection(country) {
                if (!country.id) { return country.text; }
                return $(
                    '<span><img src="https://flagcdn.com/w20/' + country.iso + '.png" class="flag-icon" /> ' + country.id + '</span>'
                );
            }

            $('#country_code').val('+256').trigger('change');

            $(document).on('click', '.sendMessage', function(event) {
                event.preventDefault();

                let form = $("#contactForm");
                let countryCode = $('#country_code').val();
                let phoneNumber = $('input[name="phone"]').val();
                let fullPhone = countryCode + phoneNumber;
                let contactInfo = form.serialize() + '&full_phone=' + encodeURIComponent(fullPhone);
                let submitButton = $('.sendMessage');

                // Clear previous errors
                $('.text-red-500').text('');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: contactInfo,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        submitButton.text('Sending...').attr('disabled', true);
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your message has been sent and Petra Church will get in touch with you shortly.',
                            confirmButtonColor: '#facc15', // Matches yellow-500
                        }).then(() => {
                            form.trigger("reset");
                            $('#country_code').val('+256').trigger('change');
                            submitButton.text('Send Message').prop('disabled', true); // Keep disabled after success
                        });
                        submitButton.text('Send Message').prop('disabled', true); 
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            for (let field in errors) {
                                $(`#${field}-error`).text(errors[field][0]);
                            }
                        } else { // Non-validation error
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong: ' + (xhr.responseJSON?.message || 'Server error'),
                                confirmButtonColor: '#facc15',
                            });
                            console.error(xhr.responseText);
                        }
                    },
                    complete: function(xhr) {
                        if (xhr.status !== 200) { // Only re-enable if not successful
                            submitButton.text('Send Message').attr('disabled', false);
                        }
                    }
                });
            });
        });
    </script>
@endsection