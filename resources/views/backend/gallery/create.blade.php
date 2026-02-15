@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title', 'Add Photos')
<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Upload Gallery Images</h5>
            </div>

            <div class="card-body">

                {{-- Title --}}
                <div class="form-group">
                    <label for="title">Title </label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label for="category">Category (Optional)</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Select Category --</option>
                        <option value="weddings">Weddings</option>
                        <option value="introductions">Introductions (Kwanjula/Kuhingira)</option>
                        <option value="corporate">Corporate Events</option>
                        <option value="sports">Sports Events</option>
                        <option value="church">Church Events</option>
                        <option value="team">Our Team</option>
                        <option value="others">Others</option>
                    </select>
                </div>


                {{-- Description --}}
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Images --}}
                <div class="form-group">
                    <label for="images">Upload Images</label>
                    <input type="file" name="images[]" id="images"
                        class="form-control-file @error('images') is-invalid @enderror" multiple>

                    @error('images')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    @error('images.*')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <small class="form-text text-muted">
                        You can select multiple images (JPG, PNG, WEBP | Max: 2MB each).
                    </small>
                </div>

            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Images
                </button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    @include('backend.components.common')

    @include('backend.blog.category_script')
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
