@extends('backend.layouts.dashboard.main')
@section('title', 'Testimonials Edit')
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <div class="mt-4">
        <h2>Edit Testimonial</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary mb-3">Back</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="client_name">Client Name <span class="text-danger">*</span></label>
                <input type="text" name="client_name" id="client_name" class="form-control"
                    value="{{ old('client_name', $testimonial->client_name) }}" required>
            </div>

            <div class="form-group">
                <label for="client_photo">Client Photo (Optional)</label>
                <input type="file" name="client_photo" id="client_photo" class="form-control-file">
                @if ($testimonial->client_photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $testimonial->client_photo) }}" alt="Client Photo"
                            class="img-thumbnail" style="width:100px; height:100px; object-fit:cover;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="event_type">Event Type</label>
                <select name="event_type" id="event_type" class="form-control">
                    <option value="">-- Select Event Type --</option>
                    @foreach ($eventTypes as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('event_type', $testimonial->event_type) == $key ? 'selected' : '' }}>{{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="message">Message <span class="text-danger">*</span></label>
                <textarea name="message" id="message" rows="4" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating" id="rating" class="form-control">
                    <option value="">-- Select Rating --</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}"
                            {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }}
                            Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input type="number" name="display_order" id="display_order" class="form-control"
                    value="{{ old('display_order', $testimonial->display_order) }}">
            </div>

            <div class="form-check mb-3">
                <!-- Hidden input ensures a value is sent even if checkbox is unchecked -->
                <input type="hidden" name="is_active" value="0">

                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                    {{ old('is_active', $testimonial->is_active ?? 1) ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Active</label>
            </div>


            <button type="submit" class="btn btn-success">Update Testimonial</button>
        </form>
    </div>
@endsection
