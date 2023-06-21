<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SIKOGA - {{ $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ url('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- CSS Datatables Libraries -->
    <link rel="stylesheet" href="{{ url('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/components.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            {{-- Topbar --}}
            @include('layout.components.header')

            {{-- Sidebar --}}
            @include('layout.components.sidebar')

            <div class="main-content" style="min-height: 85vh;">
                {{-- Content --}}
                @yield('main-content')
            </div>

            {{-- Footer --}}
            @include('layout.components.footer')

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ url('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ url('assets/modules/popper.js') }}"></script>
    <script src="{{ url('assets/modules/tooltip.js') }}"></script>
    <script src="{{ url('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ url('assets/modules/moment.min.js') }}"></script>
    <script src="{{ url('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ url('assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ url('assets/modules/chart.min.js') }}"></script>
    <script src="{{ url('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ url('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    {{-- Datatables Libraries --}}
    <script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ url('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ url('assets/js/page/index.js') }}"></script>
    <script src="{{ url('assets/js/page/modules-datatables.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ url('assets/js/scripts.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- notifications --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('pemilik/getNotify') }}",
                type: "GET",
                success: function(hasil) {
                    var obj = $.parseJSON(hasil);

                    $('div#notify').html(obj);
                    if (obj > 0) {
                        $('#beep').addClass("beep");
                    } else {
                        $("#notify_hidden").css("display", "none");
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('pemilik/getPaymentNotify') }}",
                type: "GET",
                success: function(hasil) {
                    var obj = $.parseJSON(hasil);

                    $('div#payment_notify').html(obj);
                    if (obj > 0) {
                        $('#beep').addClass("beep");
                    } else {
                        $("#notify_hiddenly").css("display", "none");
                    }
                }
            });
        });
    </script>

    {{-- Pengurus --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('pengurus/getNotify') }}",
                type: "GET",
                success: function(hasil) {
                    var obj = $.parseJSON(hasil);

                    $('div#notif_pengurus').html(obj);
                    if (obj > 0) {
                        $('#beep').addClass("beep");
                    } else {
                        $("#notif_bar").css("display", "none");
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('pengurus/getPaymentNotify') }}",
                type: "GET",
                success: function(hasil) {
                    var obj = $.parseJSON(hasil);

                    $('div#payment_pengurus').html(obj);
                    if (obj > 0) {
                        $('#beep').addClass("beep");
                    } else {
                        $("#payment_bar").css("display", "none");
                    }
                }
            });
        });
    </script>
    {{-- /notifications --}}

    @if ($message = Session::get('success'))
        <script>
            Swal.fire(
                ' ',
                '{{ $message }}',
                'success'
            )
        </script>
    @endif

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire(
                ' ',
                '{{ $message }}',
                'error'
            )
        </script>
    @endif
</body>

</html>
