<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130582519-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-130582519-1');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="app-url" content="{{ config('app.url') }}">
    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- vendor css -->
    <link href="{{ asset('assets/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/pickerjs/picker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/azia.css') }}">
    @yield('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
    <!-- Select2 CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

</head>

<body class="az-body az-light">
    <!--sidebar-->
    @include('backend.layouts.dashboard.sidebar')
    <div class="az-content az-content-dashboard-six">
        <!--top nav bar-->
        @include('backend.layouts.dashboard.topbar')


        <!-- main body content-->
        <div class="az-content-body az-content-body-dashboard-six">
            @yield('content')
        </div><!-- az-content-body -->

        <!--footer-->
        @include('backend.layouts.dashboard.footer')
    </div><!-- az-content -->

    <script>
        let baseurl = '{{ url('/') }}';
    </script>
    <!-- jQuery and Bootstrap JS -->
    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <!-- Ionicons, Flot, and Peity JS -->
    <script src="{{ asset('assets/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/lib/peity/jquery.peity.min.js') }}"></script>

    <!-- Azia and other JS -->
    <script src="{{ asset('assets/js/azia.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <!-- AmazeUI and Simple DateTime Picker JS -->
    <script src="{{ asset('assets/lib/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>

    <!-- Additional JS libraries -->
    {{-- <script src="{{ asset('assets/backend/dash/lib/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<script src="{{ asset('assets/backend/dash/lib/pickerjs/picker.min.js') }}"></script> --}}
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Moment.js for DateTime handling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <!-- Load Chart.js (v3+) and DataLabels Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <!--tinymce editor-->
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(function() {
            'use strict'

            if ($('.az-iconbar .nav-link.active').length) {
                var targ = $('.az-iconbar .nav-link.active').attr('href');
                $(targ).addClass('show');

                if (window.matchMedia('(min-width: 1200px)').matches) {
                    $('.az-iconbar-aside').addClass('remove');
                }

                if (window.matchMedia('(min-width: 992px)').matches &&
                    window.matchMedia('(max-width: 1199px)').matches) {
                    $('.az-iconbar .nav-link.active').removeClass('active');
                }
            }

            $('.az-iconbar .nav-link').on('click', function(e) {
                e.preventDefault();

                $(this).addClass('active');
                $(this).siblings().removeClass('active');

                $('.az-iconbar-aside').addClass('show');

                var targ = $(this).attr('href');
                $(targ).addClass('show');
                $(targ).siblings().removeClass('show');
            });

            $('.az-iconbar-body .with-sub').on('click', function(e) {
                e.preventDefault();
                $(this).parent().addClass('show');
                $(this).parent().siblings().removeClass('show');
            });

            $('.az-iconbar-toggle-menu').on('click', function(e) {
                e.preventDefault();
                if (window.matchMedia('(min-width: 992px)').matches) {
                    $('.az-iconbar .nav-link.active').removeClass('active');
                    $('.az-iconbar-aside').removeClass('show');
                } else {
                    $('body').removeClass('az-iconbar-show');
                }
            })

            $('#azIconbarShow').on('click', function(e) {
                e.preventDefault();
                $('body').toggleClass('az-iconbar-show');
            });

            // AmazeUI Datetimepicker
            $('#datetimepicker').datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true
            });
        });
    </script>

    <script>
        $(function() {
            'use strict'

            // Toggle Switches
            $('.az-toggle').on('click', function() {
                $(this).toggleClass('on');
            })

            $('[data-toggle="tooltip-primary"]').tooltip({
                // placement: 'right',
                container: 'body',
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
            });
        });
    </script>

    <script>
        //App base path
        var base_path = "{{ url('/') }}";
        //toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    @yield('scripts')
</body>

</html>
