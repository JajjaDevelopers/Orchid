@extends('backend.layouts.dashboard.main')

<!-- Title section -->
@section('title')
    {{ $page_title }}
@endsection

@section('css')
    <style>
        /* Responsive Table Styles */
        @media (max-width: 576px) {
            .responsive-table td[data-label]:before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 0.5rem;
            }

            .responsive-table td[data-label] {
                display: block;
                width: 100%;
                text-align: left;
                padding-left: 10px; /* Added padding for better spacing */
                border: none;
            }

            .responsive-table td {
                border: 0;
                border-bottom: 1px solid #dee2e6;
                padding-left: 10px; /* Additional padding for consistency */
            }

            .responsive-table th {
                display: none;
            }
        }
    </style>
@endsection

<!-- Main content section -->
@section('content')
    @include('backend.layouts.dashboard.common_nav')

    <div class="row mb-4">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="mb-0">All Posts</h2>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Post
            </a>
        </div>
    </div>

    <!-- Blog Posts Table -->
    <div class="row">
        <div class="col-12 overflow-auto">
            <table class="table table-bordered table-striped responsive-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Excerpt</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td data-label="#"> {{ $loop->iteration }} </td>
                            <td data-label="Title"> {{ $blog->title }} </td>
                            <td data-label="Excerpt"> {!! Str::limit($blog->excerpt ?? 'No excerpt available', 50) !!} </td>
                            <td data-label="Status">
                                <span class="badge badge-{{ $blog->status === 'published' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            </td>
                            <td data-label="Author"> {{ $blog->user->name ?? 'Unknown' }} </td>
                            <td data-label="Created At"> {{ $blog->created_at->format('M d, Y h:i A') }} </td>
                            <td data-label="Actions">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-warning me-2" data-toggle="tooltip-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip-primary" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.components.alert')
@endsection
