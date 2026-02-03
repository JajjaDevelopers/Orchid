@extends('layouts_front.app')

@section('content')
    <section class="bg-white py-12">
        <div class="max-w-2xl mx-auto bg-yellow-50 p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-yellow-800">🎟 Register for Event</h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <form action="{{ route('event.register.store') }}" method="POST" class="space-y-6" id="registerForm">
                @csrf
                <input type="hidden" name="event_id" value="{{ $eventId }}">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone" id="phone"
                        class="mt-1 block w-full border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <button type="submit"
                    class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-200 register">
                    Register
                </button>

            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.register', function(event) {
            event.preventDefault();

            let form = $("#registerForm");
            let submitButton = $('.register');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    submitButton.text('Registering...').attr('disabled', true);
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Thank You for your registration.',
                        confirmButtonColor: '#facc15',
                    }).then(() => {
                        form.trigger("reset");
                        $('#country_code').val('+256').trigger('change');
                        submitButton.text('Register').prop('disabled',
                            true);
                    });
                    submitButton.text('Register').prop('disabled', true);
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
                            text: 'Something went wrong: ' + (xhr.responseJSON?.message ||
                                'Server error'),
                            confirmButtonColor: '#facc15',
                        });
                        console.error(xhr.responseText);
                    }
                },
                complete: function(xhr) {
                    if (xhr.status !== 200) {
                        submitButton.text('Send Message').attr('disabled', false);
                    }
                }
            });
        });
    </script>
@endsection
