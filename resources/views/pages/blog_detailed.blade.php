@extends('layouts_front.app')

@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column (2/3 width) -->
            <div class="md:col-span-2 flex flex-col gap-6">
                <!-- Blog Image -->
                @if ($blog->image)
                    <img src="{{ asset($blog->image ?? 'images/blogs/blog-book.jpg') }}" alt="{{ $blog->title }}"
                        class="w-full h-48 sm:h-64 object-cover rounded-lg shadow-md mb-6">
                @endif

                <!-- Main Blog Content -->
                <div class="bg-white p-6 shadow rounded-lg space-y-4">
                    <h2 class="text-2xl font-bold text-red-800">{{ $blog->title }}</h2>
                    <p class="text-gray-600">{{ dateFormatter($blog->updated_at) }}</p>
                    <p class="text-gray-600">By <strong>{{ $blog->user->first_name }} {{ $blog->user->last_name }}</strong>
                    </p>
                    {!! $blog->content !!}
                </div>

                <!-- Author's Biography -->
                <div class="bg-white p-6 shadow rounded-lg mt-6 flex flex-col sm:flex-row items-start gap-6">
                    <div class="flex flex-col items-center">
                        @if ($blog->user->profile_picture)
                            <img src="{{ asset($blog->user->profile_picture) }}" alt="{{ $blog->user->first_name }}"
                                class="w-20 h-20 rounded-full object-cover shadow">
                        @else
                            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                                <span class="text-xl">{{ strtoupper(substr($blog->user->first_name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <h4 class="text-md font-semibold mt-2 text-center text-red-600">{{ $blog->user->first_name }}
                            {{ $blog->user->last_name }}</h4>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-red-800">About the Author</h4>
                        <p class="text-sm text-gray-600 mt-2">{{ $blog->user->bio ?? 'No biography available.' }}</p>
                    </div>
                </div>

                <!-- Comment Form -->
                <div class="bg-white p-6 rounded shadow">
                    <h4 class="text-xl font-semibold text-red-800 mb-4">Leave a Comment</h4>
                    <form id="commentForm" action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <input type="hidden" name="content" id="commentContent">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700">Comment</label>
                            <div id="editor" style="height: 200px;"></div>
                            <div id="char-count" class="text-gray-600 text-sm mt-2">0/3000 characters</div>
                        </div>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Submit
                            Comment</button>
                    </form>
                </div>

                <!-- Recent Comments Section -->
                <div class="bg-white p-4 sm:p-6 shadow rounded-lg overflow-hidden">
                    <h3 class="text-lg font-bold text-red-800 mb-4">Recent Comments</h3>
                    @if (!empty($comments) && count($comments) > 0)
                        <div class="space-y-4">
                            @foreach ($comments as $comment)
                                <div class="flex flex-col sm:flex-row sm:items-start gap-3 sm:gap-4">
                                    <!-- Avatar -->
                                    <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email))) . '?s=48&d=identicon' }}"
                                        alt="{{ $comment->name }}'s avatar"
                                        class="w-12 h-12 rounded-full border border-gray-200 flex-shrink-0">

                                    <!-- Comment Content -->
                                    <div class="flex-1 min-w-0">
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 sm:gap-3">
                                            <span class="font-semibold text-gray-800 break-words">
                                                {{ ucfirst($comment->name) }}
                                                (<a href="mailto:{{ e($comment->email) }}"
                                                    class="text-blue-600 hover:underline break-all">{{ e($comment->email) }}</a>)
                                            </span>
                                            <span class="text-sm text-gray-500 shrink-0 whitespace-nowrap">
                                                {{ $comment->created_at->format('M d, Y h:i A') }}
                                            </span>
                                        </div>
                                        <div class="text-gray-600 mt-2 prose prose-sm max-w-none break-words">
                                            {!! Purifier::clean($comment->content) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No recent comments for this blog post</p>
                    @endif
                </div>

            </div>

            <!-- Right Column (1/3 width) -->
            <div class="md:col-span-1 flex flex-col gap-6">
                <!-- Related Blogs -->
                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold text-red-800">Related Blogs</h3>
                    <ul class="list-disc pl-4 text-gray-600">
                        @if (count($relatedBlogs) > 0)
                            @foreach ($relatedBlogs as $relatedBlog)
                                <li><a href="{{ route('prbc.blog.detailed', $relatedBlog->slug) }}"
                                        class="text-red-600 hover:underline">{{ $relatedBlog->title }}</a></li>
                            @endforeach
                        @else
                            <li>No related blogs for now</li>
                        @endif
                    </ul>
                </div>

                <!-- Email Subscription -->
                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold text-red-800">Subscribe for Updates</h3>
                    <p class="text-gray-600">Enter your email to receive updates:</p>
                    <form class="mt-2" id="subscriptionForm" action="{{ route('subscription.store') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Your email" class="w-full p-2 border rounded-md"
                            required>
                        <button type="submit"
                            class="mt-2 w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-700 subscribeBtn">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Quill Editor
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['link', 'blockquote'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }]
                    ]
                }
            });

            // Set character limit
            const maxChars = 3000;
            const charCountDisplay = document.getElementById('char-count');

            // Function to update character count display
            function updateCharCount() {
                const text = quill.getText().trim(); // Get plain text without formatting
                const charCount = text.length;
                charCountDisplay.textContent = `${charCount}/${maxChars} characters`;

                // Optional: Change color if limit is reached
                if (charCount >= maxChars) {
                    charCountDisplay.classList.add('text-red-500');
                } else {
                    charCountDisplay.classList.remove('text-red-500');
                }
            }

            // Listen for text changes
            quill.on('text-change', function(delta, oldDelta, source) {
                const text = quill.getText().trim(); // Get plain text
                if (text.length > maxChars) {
                    // Truncate content to maxChars
                    quill.deleteText(maxChars, text.length);
                }
                updateCharCount();
            });

            // Update character count on initial load
            updateCharCount();

            // Sync Quill content to hidden input on form submit
            $('#commentForm').on('submit', function(e) {
                e.preventDefault();
                $('#commentContent').val(quill.root.innerHTML);
                let form = $(this);
                let submitButton = form.find('button[type="submit"]');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        submitButton.text('Submitting...').attr('disabled', true);
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your comment has been submitted.',
                            confirmButtonColor: '#dc2626', // Red to match theme
                        }).then(() => {
                            form.trigger('reset');
                            quill.setContents([]); // Clear editor
                            submitButton.text('Submit Comment').attr('disabled', false);
                            location.reload(true)
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong: ' + (xhr.responseJSON
                                ?.message || 'Server error'),
                            confirmButtonColor: '#dc2626',
                        });
                        submitButton.text('Submit Comment').attr('disabled', false);
                    }
                });
            });

            // Subscription Form Submission (Updated)
            $('#subscriptionForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let submitButton = form.find('.subscribeBtn');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        submitButton.text('Subscribing...').attr('disabled', true);
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'You’ve subscribed successfully, please check your email or spam to confirm subscription!',
                            confirmButtonColor: '#dc2626',
                        }).then(() => {
                            form.trigger('reset');
                            submitButton.text('Subscribe').attr('disabled', false);
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong.';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            // Collect all validation errors
                            let errors = xhr.responseJSON.errors;
                            errorMessage = Object.keys(errors)
                                .map(field => errors[field].join(' '))
                                .join('\n');
                        } else if (xhr.responseJSON?.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessage,
                            confirmButtonColor: '#dc2626',
                        });
                        submitButton.text('Subscribe').attr('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
