@extends('backend.layouts.dashboard.main')

<!-- Title section -->
@section('title')
    {{ $page_title }}
@endsection

@section('css')
    <style>
        /* Make table responsive */
        @media (max-width: 767px) {
            table thead {
                display: none;
                /* Hide table headers */
            }

            table td {
                display: block;
                text-align: right;
                position: relative;
                padding-left: 50%;
                padding-right: 10px;
            }

            table td::before {
                content: attr(data-label);
                font-weight: bold;
                position: absolute;
                left: 10px;
                top: 0;
                text-transform: uppercase;
                font-size: 0.8rem;
            }

            .dt-buttons .btn {
                display: inline-block !important;
                margin: 5px !important;
            }
        }
    </style>
@endsection

<!-- Main content section -->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <div class="row mb-4">
        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="mb-0">All Subscribers</h2>
            <a href="#" class="btn btn-primary mt-3 mt-lg-0" id='add_subscriber'>
                <i class="fas fa-plus-circle"></i> Add New Subscriber
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 overflow-auto">
            <!-- Make the table responsive for smaller screens -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="subscribers-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Date Subscribed</th>
                            <th>Event Subscription</th>
                            <th>Event Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <!-- Addition of Subscriber Model-->
    @include('backend.subscribers.create')

    <!-- SMALL MODAL -->
    <div id="updateSubscriber" class="modal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" id='content'>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

<!-- Scripts section -->
@section('scripts')
    <script>
        $(document).ready(function() {
            const $subscriberTable = $('#subscribers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.subscriber.view') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'event_registered',
                        name: 'event_registered'
                    },
                    {
                        data: 'event_title',
                        name: 'event_title'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-info',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    // {
                    //     extend: 'print',
                    //     className: 'btn btn-primary',
                    //     text: '<i class="fas fa-print"></i> Print'
                    // }
                ],
                initComplete: function() {
                    $('.dt-buttons button').addClass('btn');
                }
            });
            $(document).on('click', '#add_subscriber', function(event) {
                event.preventDefault()
                $("#addSubscriber").modal('show');
                $('#subscriberAdd').on('click', function(event) {
                    event.preventDefault();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('admin.subscriber.store') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: $("#subscriberForm").serialize(),
                        success: function(response) {
                            $('#subscriberForm')[0].reset();
                            $("#addSubscriber").modal('hide');
                            $subscriberTable.ajax.reload()
                            // location.reload(true);
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors
                                $.each(errors, function(field, messages) {
                                    $(`#${field}`).after(
                                        `<span class='text-danger'>${messages[0]}</span>`
                                    )
                                })

                                setTimeout(() => {
                                    location.reload()
                                }, 5000);

                                return;
                            }
                            $('#errors').append(
                                `<span class='text-danger'> Unexpected error!</span>`
                            )
                        }
                    });
                })
            });

            //get subscriber to update
            $(document).on('click', '.subscriberUpdateInfo', function(event) {
                event.preventDefault()
                $.ajax({
                    type: "GET",
                    url: $(this).attr('href'),
                    success: function(response) {
                        console.log(response)
                        $('#content').html(response.html)
                        $('#updateSubscriber').modal('show')
                    }
                });
            })
            //update subscriber
            $(document).on('click', '#subscriberUpdate', function(event) {
                event.preventDefault()
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: $("#subscriberFormUpdate").attr('action'),
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: $("#subscriberFormUpdate").serialize(),
                    success: function(response) {
                        $('#subscriberFormUpdate')[0].reset();
                        $("#updateSubscriber").modal('hide');
                        location.reload(true);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors
                            $.each(errors, function(field, messages) {
                                $(`#${field}`).after(
                                    `<span class='text-danger'>${messages[0]}</span>`
                                )
                            })

                            setTimeout(() => {
                                location.reload()
                            }, 5000);

                            return;
                        }
                        $('#errors').append(
                            `<span class='text-danger'> Unexpected error!</span>`
                        )
                    }
                });
            });
        });
    </script>
@endsection
