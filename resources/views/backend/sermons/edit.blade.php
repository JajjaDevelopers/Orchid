@extends('backend.layouts.dashboard.main')

@section('title')
    {{ $page_title }}
@endsection

@section('content')
    @include('backend.layouts.dashboard.common_nav')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Sermon</h2>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    {{-- @include('backend.components.validation_errors') --}}
                    <form method="POST" action="{{ route('admin.sermons.update', $sermon->id) }}" enctype="multipart/form-data" id='editSermonForm'>
                        @csrf
                        @method('PUT') <!-- For updating -->

                        <!-- Sermon Title -->
                        <div class="form-group mb-3">
                            <label for="title">Sermon Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $sermon->title) }}" class="form-control" placeholder="Enter the Sermon title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Brief Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter sermon description">{{ old('description', $sermon->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Preacher -->
                        <div class="form-group mb-3">
                            <label for="preacher">Preacher</label>
                            <input type="text" name="preacher" id="preacher" value="{{ old('preacher', $sermon->preacher) }}" class="form-control" placeholder="Enter preacher's name">
                            @error('preacher')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Scripture Reference -->
                        <div class="form-group mb-3">
                            <label for="scripture_reference">Scripture Reference</label>
                            <input type="text" name="scripture_reference" id="scripture_reference" value="{{ old('scripture_reference', $sermon->scripture_reference) }}" class="form-control" placeholder="e.g., John 3:16">
                            @error('scripture_reference')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date Preached -->
                        <div class="form-group mb-3">
                            <label for="preached_on">Date Preached</label>
                            <input type="date" name="preached_on" id="preached_on" value="{{ old('preached_on', $sermon->preached_on) }}" class="form-control">
                            @error('preached_on')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Audio URL -->
                        <div class="form-group mb-3">
                            <label for="audio">Sermon Audio URL</label>
                            <input type="url" name="audio_url" id="audio_url" value="{{ old('audio_url', $sermon->audio_url) }}" class="form-control" placeholder="Enter Google Drive audio link" pattern="https://drive.google.com/.*">
                            <small class="form-text text-muted">Enter the Google Drive URL for the sermon audio (MP3, WAV, etc.).</small>
                            @error('audio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Video URL -->
                        <div class="form-group mb-3">
                            <label for="video">Sermon Video URL</label>
                            <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $sermon->video_url) }}" class="form-control" placeholder="Enter YouTube video link" pattern="https://www.youtube.com/.*">
                            <small class="form-text text-muted">Enter the YouTube URL for the sermon video.</small>
                            @error('video')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image URL -->
                        <div class="form-group mb-4">
                            <label for="image">Upload Sermon Image</label>
                            <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload an image related to the sermon.</small>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Old Image if Available -->
                        @if ($sermon->image_url)
                            <div class="mb-3">
                                <label for="old_image" class="form-label">Current Sermon Image</label>
                                <img src="{{ asset($sermon->image_url) }}" alt="Old Sermon Image" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary updateSermon">
                                Update Sermon
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
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '#description',
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save(); // Ensure the content is saved to the textarea
                    });
                }
            });

            //updating sermon
            $(document).on('click', '.updateSermon', function(e) {
                e.preventDefault();
                tinymce.triggerSave();

                let formData = new FormData($("#editSermonForm")[0]);

                // Debugging: Log form fields
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                $.ajax({
                    url: $("#editSermonForm").attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function() {
                        $('.updateSermon').text('Updating....');
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success("Sermon updated successfully!");
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.sermons.view') }}";
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
                                toastr.error(errorMessages, 'Validation Error', {
                                    timeOut: 5000
                                });
                            }
                        } else if (xhr.status === 500) {
                            toastr.error('Sorry, server error has occurred!');
                        }
                    },
                    complete: function() {
                        $('.updateSermon').text('Update');
                    }
                });
            });
        });
    </script>
@endsection
