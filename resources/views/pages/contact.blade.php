@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-xl">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Get in Touch</h1>
            <p class="text-lg text-gray-600 leading-relaxed">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <!-- Alert Messages -->
        <div id="successAlert" class="hidden mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">Success</p>
                    <p id="successMessage" class="text-sm text-emerald-700 mt-1"></p>
                </div>
            </div>
        </div>

        <div id="errorAlert" class="hidden mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">Error</p>
                    <p id="errorMessage" class="text-sm text-red-700 mt-1"></p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <form id="contactForm" class="bg-white shadow-lg rounded-2xl p-8 md:p-10 border border-gray-100">
            @csrf

            <!-- Name Field -->
            <div class="mb-7">
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    placeholder="John Doe"
                >
                <span class="text-red-600 text-xs font-medium hidden mt-1 block" id="nameError"></span>
            </div>

            <!-- Email Field -->
            <div class="mb-7">
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    placeholder="john@example.com"
                >
                <span class="text-red-600 text-xs font-medium hidden mt-1 block" id="emailError"></span>
            </div>

            <!-- Phone Field -->
            <div class="mb-7">
                <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    placeholder="+1 (555) 000-0000"
                >
                <span class="text-red-600 text-xs font-medium hidden mt-1 block" id="phoneError"></span>
            </div>

            <!-- Subject Field -->
            <div class="mb-7">
                <label for="subject" class="block text-sm font-semibold text-gray-900 mb-2">Subject</label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    placeholder="What is this about?"
                >
                <span class="text-red-600 text-xs font-medium hidden mt-1 block" id="subjectError"></span>
            </div>

            <!-- Message Field -->
            <div class="mb-8">
                <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Message</label>
                <textarea 
                    id="message" 
                    name="message" 
                    required
                    rows="5"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 resize-none"
                    placeholder="Tell us more about your inquiry..."
                ></textarea>
                <span class="text-red-600 text-xs font-medium hidden mt-1 block" id="messageError"></span>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                id="submitBtn"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 disabled:opacity-60 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
            >
                <span id="btnText">Send Message</span>
                <span id="btnLoader" class="hidden">
                    <svg class="inline animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sending...
                </span>
            </button>
        </form>

        <!-- Footer Text -->
        <p class="text-center text-gray-500 text-sm mt-8">We typically respond within 24 business hours.</p>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    // Hide alerts initially
    successAlert.classList.add('hidden');
    errorAlert.classList.add('hidden');

    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Scroll to top to show alert
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Clear previous alerts
        successAlert.classList.add('hidden');
        errorAlert.classList.add('hidden');

        // Clear previous error messages
        document.querySelectorAll('[id$="Error"]').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });

        // Disable submit button and show loader
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        // Prepare form data
        const formData = new FormData(contactForm);

        try {
            const response = await fetch('{{ route("contact.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                // Success
                successMessage.textContent = data.message || 'Your message has been sent successfully!';
                successAlert.classList.remove('hidden');
                contactForm.reset();
                
                // Auto-hide success alert after 5 seconds
                setTimeout(() => {
                    successAlert.classList.add('hidden');
                }, 5000);
            } else {
                // Validation or other errors
                if (data.errors) {
                    // Display field-specific errors
                    Object.keys(data.errors).forEach(field => {
                        const errorElement = document.getElementById(field + 'Error');
                        if (errorElement) {
                            errorElement.textContent = data.errors[field][0];
                            errorElement.classList.remove('hidden');
                        }
                    });
                }
                errorMessage.textContent = data.message || 'Please check your input and try again.';
                errorAlert.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error:', error);
            errorMessage.textContent = 'An unexpected error occurred. Please try again later.';
            errorAlert.classList.remove('hidden');
        } finally {
            // Re-enable submit button and hide loader
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        }
    });
});
</script>
@endsection
