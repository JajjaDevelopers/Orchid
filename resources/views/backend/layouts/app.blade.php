@extends('backend.layouts.dashboard.main')

<!--title section-->
@section('title')
    {{ $page_title }}
@endsection

@section('css')
    <style>
        /* Calendar container styling */
        #calendar {
            max-width: 80%;
            /* Default width for larger screens */
            margin: 0 auto;
            padding: 10px;
        }

        /* Header toolbar adjustments */
        .fc-toolbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }

        .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            flex: 1 1 100%;
            /* Make title span full width */
        }

        .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        /* Buttons styling */
        .fc-button {
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .fc-button:hover {
            background-color: #0056b3;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            #calendar {
                max-width: 100%;
                padding: 5px;
            }

            .fc-toolbar {
                flex-direction: column;
                /* Stack toolbar items vertically */
            }

            .fc-toolbar-title {
                font-size: 1.2rem;
                margin-bottom: 10px;
            }

            .fc-button {
                font-size: 0.8rem;
                padding: 4px 8px;
            }
        }

        @media (max-width: 576px) {
            .fc-button {
                font-size: 0.7rem;
                padding: 3px 6px;
            }
        }

        @media only screen and (max-width: 576px) {
            #mentorship {
                margin-top: 15px;
            }
        }

        .common-div {
            border-radius: 5px;
            border-radius: 5px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.15);
            padding: 15px;
            background: #fff;
        }
    </style>
@endsection

<!--main content section-->
@section('content')
    @include('backend.layouts.dashboard.common_nav')
    <div class="row">
        <div class="col-md-12">
            <div class='bg-white common-div'>
                <canvas id="subscribersChart"></canvas>
            </div>
        </div>
    </div>
    <div class="row row-sm" style="margin-top:20px ">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="bg-white common-div">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
                headerToolbar: {
                    left: window.innerWidth < 768 ? '' : 'prev,next today',
                    center: 'title',
                    right: window.innerWidth < 768 ? 'prev,next' : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialDate: new Date(),
                themeSystem: 'bootstrap',
                selectable: false,
                dayMaxEvents: true, // Show "more" link when too many events
                windowResize: function(view) {
                    var newView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';
                    calendar.changeView(newView);
                }
            });

            calendar.render();

            //rendering charts
            subscribersChart()
            // function to render subscriber chart
            function subscribersChart() {
                var subscribers = @json($subscribers);

                // Fetch data dynamically (optional, replace with AJAX if needed)
                let active = Number(subscribers.active);
                let pending = Number(subscribers.pending);
                let unsubscribed = Number(subscribers.unsubscribed);

                let total = active + pending + unsubscribed;
                let ctx = document.getElementById("subscribersChart").getContext("2d");

                var subscribersChart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ["Active", "Pending", "Unsubscribed"],
                        datasets: [{
                            data: [active, pending, unsubscribed],
                            backgroundColor: ["#28a745", "#ffc107", "#dc3545"],
                            borderColor: ["#1e7e34", "#d39e00", "#bd2130"],
                            borderWidth: 2,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: "Subscribers Overview",
                                font: {
                                    size: 18,
                                    weight: "bold"
                                },
                                padding: {
                                    top: 10,
                                    bottom: 20
                                }
                            },
                            legend: {
                                display: true,
                                position: "bottom",
                                labels: {
                                    color: "#333",
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let value = tooltipItem.raw;
                                        let percentage = ((value / total) * 100).toFixed(1);
                                        return `${tooltipItem.label}: ${value} (${percentage}%)`;
                                    }
                                }
                            },
                            datalabels: {
                                color: "#fff",
                                font: {
                                    weight: "bold",
                                    size: 14
                                },
                                formatter: function(value, context) {
                                    let percentage = ((value / total) * 100).toFixed(1);
                                    return `${value} (${percentage}%)`;
                                }
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

        });
    </script>
@endsection
