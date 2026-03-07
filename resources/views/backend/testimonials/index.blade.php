@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title', 'Testimonials')
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    @if (isset($link))
        <div class="alert alert-info d-flex flex-column flex-md-row align-items-md-center justify-content-between">

            <div class="mb-2 mb-md-0" style="flex:1;">
                <strong>Public Testimonial Link:</strong>

                <div class="input-group mt-2">
                    <input type="text" class="form-control" id="testimonialLink" value="{{ $link }}" readonly>

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" onclick="copyTestimonialLink()">
                            Copy
                        </button>

                        <a href="https://wa.me/?text={{ urlencode('Please leave your testimonial here: ' . $link) }}"
                            target="_blank" class="btn btn-success">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Testimonials</h2>
        <div>
            <a href="{{ route('admin.testimonials.link.generate') }}" class="btn btn-success">
                <i class="fas fa-link"></i> Generate Testimonial Link
            </a>
        </div>
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
                    <th>Contact</th>
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
                        <td>{{$testimonial->phone_contact}}</td>
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
@section('scripts')
    <script>
        function copyTestimonialLink() {
            let copyText = document.getElementById("testimonialLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value);

            alert("Link copied to clipboard");
        }
    </script>
@endsection
