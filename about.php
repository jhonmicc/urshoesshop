<?php
session_start();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Urshoes Shop | About</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/favicon/android-chrome-512x512.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.html"><img src="assets/img/favicon/android-chrome-512x512.png" height="60" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">

                                    <?php
                                    if (!isset($_SESSION['login'])) {
                                        echo
                                        '<li><a href="index.php">Home</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li class="hot"><a href="product.php">Product</a></li>
                                        <li><a href="blog.php">Blog</a>
                                        <li><a href="contact.php">Contact</a></li>';
                                    } else {
                                        echo
                                        '<li><a href="index.php">Home</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li class="hot"><a href="product.php">Product</a></li>
                                        <li><a href="blog.php">Blog</a>
                                        <li><a href="contact.php">Contact</a></li>
                                        <li><a href="orderlist.php">Order List</a>';
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>
                                <?php
                                if (!isset($_SESSION['login'])) {
                                    echo '
                                <li><a href="login.php"><span class="flaticon-user"></span></a></li>
                                <li><a href="cart.php"><span class="flaticon-shopping-cart"></span></a></li>
                                ';
                                } else {
                                    echo '       
                                <li><a href="cart.php"><span class="flaticon-shopping-cart"></span></a></li>
                                <li><a href="logout.php"><img src="assets/img/icon/logout.png" height="15" alt=""></a></li>
                                ';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>About Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!-- About Details Start -->
        <div class="about-details section-padding30">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-1 col-lg-8">
                        <div class="about-details-cap mb-50">
                            <h4>Our Mission</h4>
                            <p>Menjadi toko sepatu Online yang mampu memberikan kesan puas dan nyaman di hati pelanggannya.</p>
                        </div>

                        <div class="about-details-cap mb-50">
                            <h4>Our Vision</h4>
                            <p>1. Kepuasan pelanggan adalah tujuan utama kami. </p>
                            <p>2. Mampu menyediakan variasi pilihan sepatu yang selalu mengikuti trend masa kini.</p>
                            <p>3. Mempermudah masyarakat yang mempunyai kesibukan dalam memenuhi kebutuhan sehari-harinya.</p>
                            <p>4. Memiliki berbagai jenis model sepatu yang terkait dengan keinginan para konsumen dengan mutu, harga dan kualitas yang berdaya saing tinggi melalui pengelolaan yang profesional demi kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Details End -->
        <!--? Video Area Start -->
        <div class="video-area mb-100">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="video-wrap">
                            <div class="play-btn "><a class="popup-video" href="https://www.youtube.com/watch?v=b-jgbMYb5BA"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Arrow -->
                <div class="thumb-content-box">
                    <div class="thumb-content">
                        <h3>Video</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Area End -->
        <!--? Shop Method Start-->
        <div class="shop-method-area">
            <div class="container">
                <div class="method-wrapper">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-package"></i>
                                <h6>Free Shipping Method</h6>
                                <p>We will send your product to yout place for free all cross Indonesia.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-money"></i>
                                <h6>Affordable Luxury</h6>
                                <p>We give you best and affordable price for our premium quality product.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-medall-alt"></i>
                                <h6>Urshoes Shop Guarantee</h6>
                                <p>Urshoes Shop products are covered by a 30-day warranty.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/favicon/android-chrome-512x512.png" height="60" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Urshoes shop is a shop that provides shoes with various categories so that they can be used by various ages based on their categories.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Contact Us</h4>
                                <p class="alamat">Jl. Hasanuddin No.1000, Rencana Indah, Sentosa Abadi, Bali 53897</p>
                                <ul>
                                    <li><i class="fas fa-phone"></i> Telp : 08123456789 </a></li>
                                    <li><i class="fas fa-envelope"></i> Email : Urshoesshop@gmail.com </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Navigasi</h4>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="product.php">Product</a></li>
                                    <li><a href="blog.php">Blog</a>
                                    <li><a href="contact.php">Contact</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-8 col-md-7">
                        <div class="footer-copy-right">
                            <p>
                                </script>Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a target="_blank">Urshoes shop</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-5">
                        <div class="footer-copy-right f-right">
                            <!-- social -->
                            <div class="footer-social">
                                <a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a target="_blank" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                <a target="_blank" href="https://www.world.com/"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>