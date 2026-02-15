@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title')
    {{ $page_title }}
@endsection
<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    @include('backend.blog.category_modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add Blog Post</h2>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    {{-- @include('components.validation_errors') --}}
                    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data"
                        id='addBlogForm'>
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Blog Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="form-control" placeholder="Enter the blog title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div class="d-flex flex-grow-1">
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{ ucfirst($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Red Plus Icon Button -->
                                <button type="button" class="btn btn-danger ml-2" data-toggle="modal"
                                    data-target="#addCategoryModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="form-group mb-3">
                            <label for="excerpt">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3"
                                placeholder="Short summary of the blog post">{{ old('excerpt') }}</textarea>
                        </div>
                        @error('excerpt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!-- Content -->
                        <div class="form-group">
                            <label for="description">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" placeholder="Write blog content here">
                            {{ old('content') }}
                            </textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" value="{{ old('status') }}" id="status" class="form-control">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="form-group mb-4">
                            <label for="image">Attach Blog Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                onchange="previewImage(event)">
                            @error('image.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-3">
                                <img id="imagePreview" src="#" alt="Image Preview" class="d-none img-fluid rounded"
                                    style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.blog.view') }}" class="btn btn-secondary">Cancel</a>
                            <button type="btn" class="btn btn-primary" id="addBlogBtn">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.components.common')
    @include("backend.blog.category_script")
    <script>
        function previewImage(event) {
            let input = event.target;
            let preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "#";
                preview.classList.add('d-none');
            }
        }
        $(document).ready(function() {
            $(document).on('click', '#addBlogBtn', function(e) {
                e.preventDefault();
                tinymce.triggerSave();
                let formData = new FormData($("#addBlogForm")[0]);

                // Debugging: Log form fields
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                $.ajax({
                    url: $("#addBlogForm").attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function() {
                        $('#addBlogBtn').text('Saving....');
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success("Blog added successfully!");
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.blog.view') }}";
                            }, 1500);
                        } else {
                            toastr.error("Sorry, unexpected error has occured.");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                var errorMessages = errors[field].join(', ');
                                toastr.error(errorMessages, 'Validation Error', {
                                    timeOut: 5000
                                });
                            }
                        } else if (xhr.status === 500) {
                            toastr.error('Sorry, server error has occured!')
                        }
                    },
                    complete: function() {
                        $('#addBlogBtn').text('Save');
                    }
                });
            });
        });
    </script>
@endsection
