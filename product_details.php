<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); ?>

<?php
session_start();
include 'functions.php';
$idproduk = $_GET['idproduk'];

if (isset($_POST['addprod'])) {
    if (!isset($_SESSION['login'])) {
        header('Location:login.php');
    } else {
        $ui = $_SESSION['id'];
        $cek = mysqli_query($conn, "SELECT * FROM cart where userid = '$ui' and status='Cart'");
        if ($cek > 0) {
            $liat = mysqli_num_rows($cek);
            $f = mysqli_fetch_array($cek);
            $orid = $f['orderid'];
        }

        // kalo ternyata sudah ada orderid nya
        if ($liat > 0) {

            // cek barang serupa
            $cekbarang = mysqli_query($conn, "SELECT * FROM detailorder where idproduk = '$idproduk' AND orderid='$orid'");
            $liatlg = mysqli_num_rows($cekbarang);
            $brpbanyak = mysqli_fetch_array($cekbarang);
            $jmlh = $brpbanyak['qty'];

            // kalo trnyata barangnya sudah ada
            if ($liatlg > 0) {
                $i = 1;
                $baru = $jmlh + $i;

                $updateaja = mysqli_query($conn, "UPDATE detailorder SET qty='$baru' where orderid='$orid' AND idproduk='$idproduk'");

                if ($updateaja) {
                    echo "<div class='alert alert-success'>
                    Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
                    </div>
                    <meta http-equiv='refresh' content='1; url= product.php'/>";
                } else {
                    echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php'/>";
                }
            } else {
                $tambahdata = mysqli_query($conn, "INSERT INTO detailorder (orderid, idproduk, qty) VALUES ('$orid', '$idproduk', '1')");
                if ($tambahdata) {
                    echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php'/>  ";
                } else {
                    echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php'/> ";
                }
            };
        } else {

            // kalo belom ada order id nya
            $oi = crypt(rand(22, 999), time());
            $bikincart = mysqli_query($conn, "INSERT INTO cart (orderid, userid) VALUES ('$oi', '$ui')");

            if ($bikincart) {
                $tambahuser = mysqli_query($conn, "INSERT INTO detailorder (orderid, idproduk, qty) VALUES ('$oi', '$idproduk', '1')");
                if ($tambahuser) {
                    echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php'/>  ";
                } else {
                    echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php'/> ";
                }
            } else {
                echo "gagal bikin cart";
            }
        }
    }
};

?>

<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Urshoes Shop | Product Details</title>
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
                                <h2>Product Details</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!--================Single Product Area =================-->
        <div class="product_image_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="product_img_slide owl-carousel">
                            <?php
                            $prdk = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk = '$idproduk'");
                            $data = mysqli_fetch_array($prdk);
                            ?>
                            <div class="single_product_img">
                                <img src="assets/img/gallery/<?= $data['gambar']; ?>" width="600" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="single_product_text text-center">
                            <?php
                            $prdk = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk = '$idproduk'");
                            $data = mysqli_fetch_array($prdk);
                            ?>
                            <h3><?= $data['namaproduk']; ?></h3>
                            <p><?= $data['deskripsi']; ?></p>
                            <div class="card_area">
                                <div class="add_to_cart">
                                    <form action="#" method="post">
                                        <fieldset>
                                            <input type="hidden" name="idprod" value="<?= $data['idproduk']; ?>">
                                            <input type="submit" name="addprod" value="Add to cart" class="button">
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Single Product Area =================-->
        <!-- subscribe part here -->

        <!-- subscribe part end -->
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

    <!-- swiper js -->
    <script src="./assets/js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="./assets/js/mixitup.min.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>

</body>

</html>