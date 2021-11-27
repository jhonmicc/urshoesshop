<?php
session_start();
require 'functions.php';



?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Urshoes Shop | Product</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> -->

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
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/favicon/android-chrome-512x512.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php"><img src="assets/img/favicon/android-chrome-512x512.png" height="60" alt=""></a>
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
                                <h2>Urshoes Shop</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!-- Latest Products Start -->
        <section class="popular-items latest-padding">
            <div class="container">
                <div class="row product-btn justify-content-between mb-40">
                    <div class="properties__button">
                        <!--Nav Button  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php
                                $ktgr = mysqli_query($conn, "SELECT * FROM kategori");
                                while ($data = mysqli_fetch_assoc($ktgr)) {
                                    $data2 = $data['idkategori'];
                                    $data3 = $data['namakategori'];
                                ?>
                                    <a class="nav-item nav-link" id="<?= 'nav-' . $data2 . '-tab' ?>" data-toggle="tab" href="<?= '#nav-' . $data2 ?>" role="tab" aria-controls="<?= 'nav-' . $data2 ?>" aria-selected="true"><?= $data3;  ?></a>

                                <?php
                                }
                                ?>
                            </div>
                        </nav>
                        <!--End Nav Button  -->
                    </div>
                    <!-- Grid and List view -->
                    <div class="grid-list-view">
                    </div>
                    <!-- Select items -->

                </div>
                <!-- Nav Card sneakers-->
                <div class="tab-content" id="nav-tabContent">

                    <?php
                    $ktgr = mysqli_query($conn, "SELECT * FROM produk");
                    while ($data = mysqli_fetch_assoc($ktgr)) {
                        $data2 = $data['idkategori'];
                    ?>
                        <div class="tab-pane fade" id="<?= 'nav-' . $data2 ?>" role="tabpanel" aria-labelledby="<?= 'nav-' . $data2 . '-tab' ?>">
                            <div class="row">
                                <?php

                                $perPage = 6;
                                $result = mysqli_query($conn, "SELECT * FROM produk WHERE idkategori = '$data2'");
                                $result2 = mysqli_fetch_assoc($result);
                                $jumlahData = count($result2);
                                $jumlahHalaman = ceil($jumlahData / $perPage);
                                $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                $awalData = ($perPage * $halamanAktif) - $perPage;

                                $produk = mysqli_query($conn, "SELECT * FROM produk WHERE idkategori = '$data2' LIMIT $awalData, $perPage");

                                while ($data3 = mysqli_fetch_assoc($produk)) {
                                    $gambarproduk = $data3['gambar'];
                                    $namaproduk = $data3['namaproduk'];
                                    $hargaproduk = $data3['harga'];
                                    $idproduk = $data3['idproduk'];
                                ?>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                        <div class="single-popular-items mb-50 text-center">
                                            <div class="popular-img">
                                                <img src="assets/img/gallery/<?= $gambarproduk ?>" alt="">

                                            </div>
                                            <div class="popular-caption">
                                                <h3><a href="product_details.php?idproduk=<?= $idproduk ?>"><?= $namaproduk ?></a></h3>
                                                <span>Rp <?= number_format($hargaproduk); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <?php if ($halamanAktif > 1) : ?>
                                        <li class="page-item">
                                            <a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link" aria-label="Previous">
                                                <i class="ti-angle-left"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i < $jumlahHalaman; $i++) : ?>
                                        <?php if ($i == $halamanAktif) : ?>
                                            <li class="page-item">
                                                <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;" class="page-link"><?= $i; ?></a>
                                            </li>
                                        <?php else : ?>
                                            <li class="page-item">
                                                <a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                        <li class="page-item">
                                            <a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link" aria-label="Next">
                                                <i class="ti-angle-right"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>

                        </div>
                    <?php
                    }
                    ?>

                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
        <!-- pagination -->

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
    <!-- All JS Custom Plugins Link Here here -->
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

    <!-- Scroll up, nice-select, sticky -->
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