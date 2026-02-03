@extends('backend.layouts.dashboard.main')

<!-- Title Section -->
@section('title')
    {{ $page_title ?? 'Contact Details' }}
@endsection

<!-- Main Content Section -->
@section('content')
@include('backend.layouts.dashboard.common_nav')
<div class="cont">
    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-md-8"> <!-- Change col-md-12 to col-md-8 for a wider card -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="card-title">Contact Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong> <span>{{ $contact->name }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> <span>{{ $contact->email }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Subject:</strong>
                        <p>{{ $contact->subject }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Message:</strong>
                        <p>{{ $contact->message }}</p>
                    </div>
                    <div class="mb-4">
                        <strong>Status:</strong>
                        @if($contact->replied_to)
                            <span class="badge bg-success">Replied</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </div>

                    <!-- Response Form -->
                    @if (!$contact->replied_to)
                        <form action="{{ route('admin.contact.reply', $contact->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="response" class="form-label">Your Response:</label>
                                <textarea name="response" id="response" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    Send Response
                                </button>
                                <a href="{{ route('admin.contact.mark-replied', $contact->id) }}" class="btn btn-secondary">
                                    Mark as Replied
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-success" role="alert">
                            This message has been replied to.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<!-- Scripts Section -->
@section('scripts')
    @include('backend.components.common')
@endsection
