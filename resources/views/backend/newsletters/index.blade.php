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
        <h2 class='mb-0'>All Newsletters</h2>

        <!-- Display Success Message -->
        {{-- @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <span> {{ session('error') }} </span>
            </div>
        @endif --}}

        <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary mt-3 mt-lg-0">
            <i class="fas fa-plus-circle"></i> Add New Newsletter
        </a>
    </div>
</div>

<!-- Newsletters Table -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped responsive-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Excerpt</th>
                        <th>Sent Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletters as $newsletter)
                        <tr>
                            <td data-label="#"> {{ $loop->iteration }} </td>
                            <td data-label="Subject"> {{ $newsletter->subject }} </td>
                            <td data-label="Excerpt"> {!! Str::limit($newsletter->content, 50) !!} </td>
                            <td data-label="Sent Status">
                                @if($newsletter->is_sent)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Sent
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Pending</span>
                                @endif
                            </td>
                            <td data-label="Created At"> {{ $newsletter->created_at->format('M d, Y h:i A') }} </td>
                            <td class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-2">
                                <a href="{{ route('admin.newsletter.edit', $newsletter->id) }}" class="btn btn-sm btn-warning w-10 w-sm-auto" data-toggle="tooltip-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.newsletter.send', $newsletter->id) }}" method="POST" class="d-inline-block w-10 w-sm-auto sendNewsletterForm">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-10 w-sm-auto sendButton" data-toggle="tooltip-primary" title="Send">
                                        <i class="fas fa-paper-plane"></i> <span class="buttonText"></span>
                                        <div class="spinner-border spinner-border-sm text-light ms-2 d-none spinner" role="status"></div>
                                    </button>
                                </form>
                                <form action="{{ route('admin.newsletter.destroy', $newsletter->id) }}" method="POST" class="d-inline-block w-10 w-sm-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100 w-sm-auto" data-toggle="tooltip-primary" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('backend.components.alert')
<script>
    $(document).ready(function () {
        $('.sendNewsletterForm').on('submit', function (e) {
            const $sendButton = $(this).find('.sendButton');
            const $buttonText = $(this).find('.buttonText');
            const $spinner = $(this).find('.spinner');

            $sendButton.prop('disabled', true);
            $buttonText.text('Sending...');
            $spinner.removeClass('d-none');
        });
    });
</script>
@endsection
