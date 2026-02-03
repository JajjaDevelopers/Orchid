@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title')
    {{ $page_title }}
@endsection
<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add Event</h2>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    {{-- @include('backend.components.validation_errors') --}}
                    <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data"
                        id='addEventForm'>
                        @csrf

                        <!-- Sermon Title -->
                        <div class="form-group mb-3">
                            <label for="title">Event Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="form-control" placeholder="Enter the event title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Brief Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter event description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Scripture Reference -->
                        <div class="form-group mb-3">
                            <label for="scripture_reference">Scripture Reference</label>
                            <input type="text" name="scripture_reference" id="scripture_reference"
                                value="{{ old('scripture_reference') }}" class="form-control" placeholder="e.g., John 3:16">
                            @error('scripture_reference')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- venue -->
                        <div class="form-group mb-3">
                            <label for="scripture_reference">Venue</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}"
                                class="form-control" placeholder="Event Venue">
                            @error('location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Event Date and Time-->
                        {{-- <div class="form-group mb-3">
                            <label for="date">Event Date and Time</label>
                            <input type="text" name="date" id="datetimepicker" value="{{ old('date') }}"
                                class="form-control">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-3">
                            <label for="date">Event Date </label>
                            <input type="date" name="date"  value="{{ old('date') }}"
                                class="form-control">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date">Sart Time</label>
                                    <input type="time" name="start_time" value="{{ old('start_time') }}"
                                        class="form-control">
                                    @error('start_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date">End Time</label>
                                    <input type="time" name="end_time" value="{{ old('end_time') }}"
                                        class="form-control">
                                    @error('end_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Image URL -->
                        <div class="form-group mb-4">
                            <label for="image">Upload Event Poster</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload Event Poster.</small>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary addEvent">
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

            $(document).on('click', '.addEvent', function(e) {
                e.preventDefault();

                tinymce.triggerSave();

                let formData = new FormData($("#addEventForm")[0]);

                // Debugging: Log form fields
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}:`, value);
                }

                $.ajax({
                    url: "{{ route('admin.event.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    beforeSend: function() {
                        $('.addEvent').text('Saving....');
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success("Event added successfully!");
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.event.view') }}";
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
                        $('.addEvent').text('Save');
                    }
                });
            });
        });
    </script>
@endsection
