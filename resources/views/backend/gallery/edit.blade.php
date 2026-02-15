@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title', 'Update Photo')
<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title (Optional)</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $gallery->title) }}">
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Updated Category Dropdown --}}
        <div class="form-group">
            <label for="category">Category (Optional)</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">-- Select Category --</option>
                <option value="weddings" {{ old('category', $gallery->category) == 'weddings' ? 'selected' : '' }}>Weddings
                </option>
                <option value="introductions"
                    {{ old('category', $gallery->category) == 'introductions' ? 'selected' : '' }}>Introductions
                    (Kwanjula/Kuhingira)</option>
                <option value="corporate" {{ old('category', $gallery->category) == 'corporate' ? 'selected' : '' }}>
                    Corporate Events</option>
                <option value="sports" {{ old('category', $gallery->category) == 'sports' ? 'selected' : '' }}>Sports Events
                </option>
                <option value="church" {{ old('category', $gallery->category) == 'church' ? 'selected' : '' }}>Church Events
                </option>
                <option value="team" {{ old('category', $gallery->category) == 'team' ? 'selected' : '' }}>Our Team
                </option>
                <option value="others" {{ old('category', $gallery->category) == 'others' ? 'selected' : '' }}>Others
                </option>
            </select>
            @error('category')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" rows="3"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $gallery->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Current Image Preview --}}
        <div class="form-group">
            <label>Current Image</label>
            <div>
                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title ?? 'Gallery Image' }}"
                    class="img-thumbnail" style="max-width: 200px; max-height: 150px; object-fit: cover;">
            </div>
        </div>

        {{-- Upload New Image --}}
        <div class="form-group">
            <label for="image">Replace Image (Optional)</label>
            <input type="file" name="image" id="image"
                class="form-control-file @error('image') is-invalid @enderror">
            @error('image')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Gallery Image</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
@section('scripts')
    @include('backend.components.common')
@endsection
