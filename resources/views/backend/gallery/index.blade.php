@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title', 'Gallery')
@section('content')
<div>
    @include('backend.layouts.dashboard.common_nav')
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Gallery Images</h3>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            Upload New Images
        </a>
    </div>

    @if($images->count())
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Uploaded At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $index => $image)
                    <tr>
                        <td>{{ $images->firstItem() + $index }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->title ?? 'Gallery Image' }}" 
                                 class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                        </td>
                        <td>{{ $image->title ?? '-' }}</td>
                        <td>{{ ucfirst($image->category) ?? '-' }}</td>
                        <td>{{ strip_tags($image->description)?? '-' }}</td>
                        <td>{{ $image->created_at->format('d M, Y') }}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.gallery.edit', $image->id) }}" class="btn btn-sm btn-warning mr-2">
                                Edit
                            </a>

                            <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $images->links() }}
    </div>

    @else
        <div class="alert alert-info text-center">
            No gallery images found. <a href="{{ route('admin.gallery.create') }}">Upload some now</a>.
        </div>
    @endif

</div>
@endsection
