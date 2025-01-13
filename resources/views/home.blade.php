<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('/assets/img/logo.png') }}" type="image/x-icon" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">BPS Provinsi DKI Jakarta</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    
                    <li><a href="#about">About</a></li>
                    
                    
                    @if (auth()->user())
                    <li><a href="/dashboard/">Dashboard</a></li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-lg-4 col-md-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="assets/img/icon-landing-page.png" class="img-fluid animated sm" alt="">
                    </div>
                    <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                        <h1>Sistem Bukti Dukung <span>Administratif</span></h1>
                        <p>Sistem pengajuan bukti dukung administratif untuk pegawai BPS Provinsi DKI Jakarta</p>
                        <div class="d-flex">
                            <a href="/login" class="btn-get-started">Login</a>
                        </div>
                    </div> 
                </div>
            </div>

            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3"></use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0"></use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->


               <!-- About Section -->
        <section id="about" class="about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center gy-4">

                    <!-- About Content -->
                    <div class="row mb-4">
                        <div class="col-lg-12 text-center">
                            <div class="content">
                                <!--<h3>About Us</h3>-->
                                <h2>Sistem Bukti Dukung Administrasi</h2>
                                <p>Merupakan alat bantu untuk mempermudah pegawai BPS Provinsi DKI Jakarta dalam mengajukan bukti dukung administrasi pada kegiatan yang telah mereka lakukan.</p>
                                <a href="#" class="read-more"><span>Baca SOP Pengajuan Bukti Dukung Administrasi</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Boxes -->
                    <div class="row gy-4">

                        <!-- Icon Box 1 -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box">
                                <i class="bi bi-buildings"></i>
                                <h3>Sistem Ramah Lingkungan</h3>
                                <p>Mendukung dalam mengurangi penggunaan kertas untuk proses administrasi</p>
                            </div>
                        </div>

                        <!-- Icon Box 2 -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="bi bi-clipboard-pulse"></i>
                                <h3>Monitoring Pengajuan</h3>
                                <p>Monitoring pengajuan yang lebih efektif dengan adanya fitur notifikasi</p>
                            </div>
                        </div>

                        <!-- Icon Box 3 -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="bi bi-command"></i>
                                <h3>Kolaborasi</h3>
                                <p>Mendukung proses kolaborasi pegawai BPS Provinsi DKI Jakarta</p>
                            </div>
                        </div>

                        <!-- Icon Box 4 -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <i class="bi bi-graph-up-arrow"></i>
                                <h3>Efektivitas Kerja</h3>
                                <p>Sistem bukti dukung administrasi keuangan yang lebih baik akan meningkatkan efektivitas dalam setiap proses pengajuan dan persetujuannya</p>
                            </div>
                        </div>

                    </div> <!-- End Icon Boxes Row -->


                </div> <!-- End Main Row -->
            </div> <!-- End Container -->
        </section> <!-- /About Section -->

    </main>

    <footer id="footer" class="mt-12 footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Badan Pusat Statistik Provinsi DKI Jakarta</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Salemba Tengah No. 36-38</p>
                        <p>Paseban Senen Jakarta Pusat</p>
                        <p class="mt-3"><strong>Phone </strong> <span>(021) 31928493</span></p>
                        <p><strong>Fax </strong> <span>(021) 3152004</span></p>
                        <p><strong>Email: </strong> <span>bps3100@bps.go.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="https://www.x.com/bpsdkijakarta"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://www.facebook.com/bpsdkijakarta"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/bpsdkijakarta"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/c/BPSDKI"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">2024/2025</strong> <span>BPS Provinsi DKI Jakarta</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                <a href="mailto:bps3100@bps.go.id">E-mail : bps3100@bps.go.id</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>
