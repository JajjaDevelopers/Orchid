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
            <h2 class="mb-0">Sermons List</h2>
            <a href="{{ route('admin.sermons.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Sermon
            </a>
        </div>
    </div>

    <!-- sermons Table -->
    <div class="row">
        <div class="col-12 overflow-auto">
            <table class="table table-bordered table-striped responsive-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Preacher</th>
                        <th>Scripture Reference</th>
                        <th>Preached On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sermons as $sermon)
                        <tr>
                            <td data-label="#"> {{ $loop->iteration }} </td>
                            <td data-label="Title"> {{ $sermon->title }} </td>
                            <td data-label="Description"> {!! Str::limit($sermon->description ?? 'No Description available', 50) !!} </td>
                            <td data-label="Preacher">
                                    {{ ucfirst($sermon->preacher) }}
                            </td>
                            <td data-label="ScriptureReference"> {{ $sermon->scripture_reference ?? 'N/A' }} </td>
                            <td data-label="Date Preached"> {{ $sermon->preached_on }} </td>
                            <td data-label="Actions">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.sermons.edit', $sermon->id) }}" class="btn btn-sm btn-warning me-2" data-toggle="tooltip-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sermons.destroy', $sermon->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Sermon?');">
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
