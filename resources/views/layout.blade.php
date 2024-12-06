<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Bukti Dukung Administrasi | BPS DKI Jakarta</title>
    <style>
        .modal-body {
            padding: 15px;
        }

        .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .notif-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            margin-right: 10px;
        }

        .notif-success {
            background-color: #28a745;
            /* Green for success */
        }

        .notif-danger {
            background-color: #dc3545;
            /* Red for danger */
        }

        .notification-text strong {
            font-size: 14px;
            color: #333;
        }

        .notification-text p {
            font-size: 12px;
            color: #666;
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <link
        rel="icon"
        href="{{ asset('/assets/img/kaiadmin/favicon.ico') }}"
        type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },  
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
</head>

<body class="antialiased">
    <div class="wrapper">
        @include('_sidebar')

        <div class="main-panel">
            @include('_navbar')
            @include('/modal/_notifAll')
            @include('/modal/_notifAcc')
            @include('/modal/_notifTolak')
            @yield('content')
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('/assets/js/kaiadmin.min.js') }}"></script>

    <script>
        const ctx = document.getElementById('statisticsChart').getContext('2d');
        const data = {
            labels: ['Jumlah Pengajuan', 'Approved', 'Rejected', 'Dalam Proses'],
            datasets: [{
                label: 'Statistik Pengajuan',
                data: [594, 303, 45, 76],
                backgroundColor: ['blue', 'green', 'red', 'orange'],
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const statisticsChart = new Chart(ctx, config);
    </script>

</body>

</html>