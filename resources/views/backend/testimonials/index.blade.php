@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title', 'Testimonials')
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Client Photo</th>
                    <th>Client Name</th>
                    <th>Event Type</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Active</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>{{ $loop->iteration + ($testimonials->currentPage() - 1) * $testimonials->perPage() }}
                        </td>
                        <td>
                            @if ($testimonial->client_photo)
                                <img src="{{ asset('storage/' . $testimonial->client_photo) }}" alt="Client Photo"
                                    class="img-thumbnail" style="width:60px; height:60px; object-fit:cover;">
                            @else
                                <span class="text-muted">No Photo</span>
                            @endif
                        </td>
                        <td>{{ $testimonial->client_name }}</td>
                        <td>{{ ucfirst($testimonial->event_type) ?? 'N/A' }}</td>
                        <td>{{ Str::limit($testimonial->message, 50) }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $testimonial->rating)
                                    <span class="text-warning">&#9733;</span>
                                @else
                                    <span class="text-secondary">&#9733;</span>
                                @endif
                            @endfor
                        </td>
                        <td>
                            @if ($testimonial->is_active)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $testimonial->display_order }}</td>
                        <td>
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No testimonials found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $testimonials->links() }}
        </div>
    </div>
@endsection
