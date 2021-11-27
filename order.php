<?php
session_start();
include 'functions.php';
error_reporting(0);

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
}
$idorder = $_GET['id'];

$uid = $_SESSION['id'];
$caricart = mysqli_query($conn, "SELECT * FROM cart WHERE userid = '$uid' AND status = 'Cart'");
$fetc = mysqli_fetch_array($caricart);
$orderidd = $fetc['orderid'];
$itungtrans = mysqli_query($conn, "SELECT count(detailid) AS jumlahtrans FROM detailorder WHERE orderid = '$orderidd'");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];

if (isset($_POST["update"])) {
    $kode = $_POST['idproduknya'];
    $jumlah = $_POST['jumlah'];
    $q1 = mysqli_query($conn, "UPDATE detailorder SET qty = '$jumlah' WHERE idproduk='$kode' AND orderid = '$orderidd'");
    if ($q1) {
        echo "Berhasil Update Cart
		<meta http-equiv='refresh' content='0; url= cart.php'/>";
    } else {
        echo "Gagal update cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
    }
} else if (isset($_POST["hapus"])) {
    $kode = $_POST['idproduknya'];
    $q2 = mysqli_query($conn, "DELETE FROM detailorder where idproduk = '$kode' and orderid = '$orderidd'");
    if ($q2) {
        echo "Berhasil Hapus";
    } else {
        echo "Gagal Hapus";
    }
}


// if (!isset($_SESSION["login"])) {
//   header("Location: login.php");
//   exit;
// }
?>

<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Urshoes Shop | Cart</title>
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
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <style>
        .qty {
            width: 40px;
            height: 25px;
            text-align: center;
        }

        input.qtyplus {
            width: 25px;
            height: 25px;
        }

        input.qtyminus {
            width: 25px;
            height: 25px;
        }

        th {
            text-align: center;
        }
    </style>
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
                            <a href="index.php"><img src="assets/img/favicon/android-chrome-512x512.png" height="60" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li class="hot"><a href="product.php">Product</a></li>
                                    <li><a href="blog.php">Blog</a>
                                    <li><a href="contact.php">Contact</a></li>
                                    <li><a href="orderlist.php">Order List</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <ul>

                                <li><a href="cart.php"><span class="flaticon-shopping-cart"></span></a></li>
                                <li><a href="logout.php"><img src="assets/img/icon/logout.png" height="15" alt=""></a></li>

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
                                <h2>Cart List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================Cart Area =================-->
        <section class="cart_area section_padding">
            <div class="container">
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $prdk = mysqli_query($conn, "SELECT * FROM detailorder d, produk p WHERE orderid = '$idorder' AND d.idproduk = p.idproduk ORDER BY d.idproduk ASC");

                                $subtotal = 30000;
                                while ($result = mysqli_fetch_array($prdk)) {
                                    $harga = $result['harga'];
                                    $kuantitas = $result['qty'];
                                    $totalharga = $harga * $kuantitas;
                                    $subtotal = $subtotal + $totalharga;

                                ?>
                                    <tr class="rem1">
                                        <form method="post">
                                            <td class="invert">
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="assets/img/gallery/<?= $result['gambar']; ?>" alt="">
                                                    </div>
                                                    <div>
                                                        <p><?= $result['namaproduk']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="invert">
                                                <h5>
                                                    Rp<?= number_format($result['harga']); ?>
                                                </h5>
                                            </td>
                                            <td class="invert">
                                                <div class="quantity">
                                                    <div class="quantity-select">
                                                        <input type="number" min="0" name="jumlah" class="form-control" height="100px" value="<?php echo $result['qty'] ?>" \>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="invert">
                                                <p>Rp<?= number_format($totalharga); ?></p>
                                            </td>

                                    </tr>
                    </div>
                    <script>
                        $(document).ready(function(c) {
                            $('.close1').on('click', function(c) {
                                $('.rem1').fadeOut('slow', function(c) {
                                    $('.rem1').remove();
                                });
                            });
                        });
                    </script>
                    </td>
                    </tr>
                <?php
                                }
                ?>

                <tr>
                    <td></td>
                    <td></td>

                    <td>
                        <h5>Shipping</h5>
                    </td>
                    <td>
                        <div class="shipping_box">
                            <ul class="list">
                                <li>
                                    <h5>Rp<?= number_format(30000); ?></h5>
                                </li>
                        </div>
                    </td>

                </tr>
                <tr class="shipping_area">
                    <td></td>
                    <td></td>

                    <td>
                        <h5>Subtotal</h5>
                    </td>
                    <td>
                        <h5>Rp<?= number_format($subtotal) ?></h5>
                    </td>
                </tr>
                </tbody>
                </table>
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="product.php">Continue Shopping</a>
                    <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
                </div>
                </div>
            </div>
        </section>
        <!--quantity-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>
            $('.value-plus').on('click', function() {
                var divUpd = $(this).parent().find('.value'),
                    newVal = parseInt(divUpd.text(), 10) + 1;
                divUpd.text(newVal);
            });

            $('.value-minus').on('click', function() {
                var divUpd = $(this).parent().find('.value'),
                    newVal = parseInt(divUpd.text(), 10) - 1;
                if (newVal >= 1) divUpd.text(newVal);
            });
        </script>
        <!--quantity-->
        <!--================End Cart Area =================-->
    </main>>
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
    <!--? Search model Begin -->
    <div class="search-model-box">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Searching key.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

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

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

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