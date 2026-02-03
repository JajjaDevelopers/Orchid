@extends('backend.layouts.dashboard.main')

<!-- Title section -->
@section('title')
    {{ $page_title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12 overflow-auto">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Homepage Carousel</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.frontpage.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="carousel_images[]">Upload New Images</label>
                            <input type="file" name="carousel_images[]" class="form-control" multiple>
                            <small class="text-muted">You can select multiple images</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload and Update Carousel</button>

                        <hr>

                        <div class="row">
                            @if ($carousel)
                                <h6 class="mt-4">Current Carousel Images:</h6>
                                <div class="row">
                                    @forelse ($carousel->carousel_array as $img)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ asset($img) }}" class="img-fluid rounded mb-2" />
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_images[]"
                                                    value="{{ $img }}" id="delete_{{ md5($img) }}">
                                                <label class="form-check-label text-danger"
                                                    for="delete_{{ md5($img) }}">
                                                    Delete this image
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">No images uploaded yet.</p>
                                        </div>
                                    @endforelse
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    No carousel data found. Please create a new entry first.
                                </div>
                            @endif
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
