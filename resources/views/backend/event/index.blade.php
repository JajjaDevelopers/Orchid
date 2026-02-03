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
            <h2 class="mb-0">Events List</h2>
            <a href="{{ route('admin.event.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Event
            </a>
        </div>
    </div>

    <!-- events Table -->
    <div class="row">
        <div class="col-12 overflow-auto">
            <table class="table table-bordered table-striped responsive-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Scripture Reference</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td data-label="#"> {{ $loop->iteration }} </td>
                            <td data-label="Title"> {{ $event->title }} </td>
                            <td data-label="Description"> {!! Str::limit($event->description ?? 'No Description available', 50) !!} </td>
                            <td data-label="ScriptureReference"> {{ $event->scripture_reference ?? 'N/A' }} </td>
                            <td data-label="Date"> {{ $event->date}} </td>
                            <td data-label="Venue"> {{ $event->location}}</td>
                            <td data-label="Actions">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-sm btn-warning me-2" data-toggle="tooltip-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this event?');">
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
