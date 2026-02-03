@extends('backend.layouts.dashboard.main')

<!--title section-->
@section('title')
    Edit Blog Post
@endsection

<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    @include('backend.blog.category_modal')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Blog Post</h2>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    {{-- @include('components.validation_errors') --}}
                    <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" id='editBlogForm'>
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title">Blog Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" class="form-control" placeholder="Enter the blog title">
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
                                        <option value="{{ $category->id }}" {{ old('category', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ ucfirst($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Red Plus Icon Button -->
                                <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#addCategoryModal">
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
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Short summary of the blog post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        </div>
                        @error('excerpt')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <!-- Content -->
                        <div class="form-group">
                            <label for="description">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" placeholder="Write blog content here">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="form-group mb-4">
                            <label for="image">Attach Blog Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                            @error('image.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- Display Old Image if Available -->
                        @if ($blog->image)
                            <div class="mb-3">
                                <label for="old_image" class="form-label">Current Image</label>
                                <img src="{{ asset($blog->image) }}" alt="Old Sermon Image" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                            <div class="mt-3">
                                <img id="imagePreview" src="{{ old('image', $blog->image ? asset('storage/' . $blog->image) : '') }}" alt="Image Preview" class="d-none img-fluid rounded" style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.blog.view') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="editBlogBtn">
                                Update
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
            $(document).on('click', '#editBlogBtn', function(e) {
                e.preventDefault();
                tinymce.triggerSave();
                let formData = new FormData($("#editBlogForm")[0]);

                $.ajax({
                    url: $("#editBlogForm").attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function() {
                        $('#editBlogBtn').text('Updating....');
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success("Blog updated successfully!");
                            setTimeout(() => {
                                window.location.href = "{{ route('admin.blog.view') }}";
                            }, 1500);
                        } else {
                            toastr.error("Sorry, unexpected error has occurred.");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                var errorMessages = errors[field].join(', ');
                                toastr.error(errorMessages, 'Validation Error', { timeOut: 5000 });
                            }
                        } else if (xhr.status === 500) {
                            toastr.error('Sorry, server error has occurred!');
                        }
                    },
                    complete: function() {
                        $('#editBlogBtn').text('Update');
                    }
                });
            });
        });
    </script>
@endsection
