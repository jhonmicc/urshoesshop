<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['login'])) {
  header('location:login.php');
}

$uid = $_SESSION['id'];
$caricart = mysqli_query($conn, "SELECT * FROM cart WHERE userid = '$uid' AND status = 'Cart'");
$fetc = mysqli_fetch_array($caricart);
$orderidd = $fetc['orderid'];
$itungtrans = mysqli_query($conn, "SELECT count(detailid) AS jumlahtrans FROM detailorder WHERE orderid = '$orderidd'");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];

if (isset($_POST["checkout"])) {

  $q3 = mysqli_query($conn, "update cart set status='Payment' where orderid='$orderidd'");
  if ($q3) {
    echo "Berhasil Check Out
		<meta http-equiv='refresh' content='1; url= orderlist.php'/>";
  } else {
    echo "Gagal Check Out
		<meta http-equiv='refresh' content='1; url= index.php'/>";
  }
} else {
}
?>

<!doctype html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Urshoesshop | Payment</title>
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
                <h2>Payment</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ confirmation part start =================-->
    <section class="confirmation_part section_padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="confirmation_tittle">
              <span>Thank you. Your order has been received.</span>
            </div>
          </div>
          <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
              <h4>order info</h4>
              <?php
              $prdk = mysqli_query($conn, "SELECT * FROM detailorder d, produk p WHERE orderid = '$orderidd' AND d.idproduk = p.idproduk ORDER BY d.idproduk ASC");
              $subtotal = 30000;
              while ($res = mysqli_fetch_array($prdk)) {
                $harga = $res['harga'];
                $n = $res['qty'];
                $total = $harga * $n;
                $subtotal = $subtotal + $total;
              }
              ?>
              <ul>
                <li>
                  <p>order code</p><span>: #<?= $orderidd; ?></span>
                </li>

                <li>
                  <p>total</p><span>: Rp. <?= number_format($subtotal); ?></span>
                </li>

              </ul>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="order_details_iner">
              <h3>Order Details</h3>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col" colspan="2">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <?php
                $prdk = mysqli_query($conn, "SELECT * FROM detailorder d, produk p WHERE orderid = '$orderidd' AND d.idproduk = p.idproduk ORDER BY d.idproduk ASC");
                $subtotal = 30000;
                while ($res = mysqli_fetch_array($prdk)) {
                  $harga = $res['harga'];
                  $n = $res['qty'];
                  $total = $harga * $n;
                  $subtotal = $subtotal + $total;
                ?>
                  <tbody>
                    <tr>
                      <th colspan="2"><span><?= $res['namaproduk']; ?></span></th>
                      <th>x<?= $res['qty']; ?></th>
                      <th> <span>Rp. <?= number_format($total); ?></span></th>
                    </tr>
                  <?php
                }
                  ?>
                  <tr>
                    <th colspan="3">shipping</th>
                    <th><span>Rp. <?= number_format(30000); ?></span></th>
                  </tr>
                  <tr>
                    <th colspan="3">Total</th>
                    <th> <span>Rp. <?= number_format($subtotal); ?></span></th>
                  </tr>

                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <br>
        <hr>
        <br>
        <center>
          <h5>Total harga yang tertera di atas sudah termasuk ongkos kirim sebesar Rp30.000</h5>
          <h5>Bila telah melakukan pembayaran, harap konfirmasikan pembayaran Anda.</h5>
          <br>

          <table class="table" style="text-align: center;">
            <thead class="thead-dark">
              <tr>
                <th scope="col" colspan="2">Metode Pembayaran</th>
              </tr>
            </thead>
            <?php
            $bayar = mysqli_query($conn, "SELECT * FROM metodepembayaran");
            while ($met = mysqli_fetch_array($bayar)) {
            ?>
              <tbody>
                <tr>
                  <td>
                    <img src="<?= $met['logo']; ?>" width="200">
                    <h4><?= $met['norek']; ?></h4>
                    <h4><?= $met['an']; ?></h4>
                  </td>
                </tr>

              </tbody>
          </table>
        <?php
            }
        ?>
        <br>
        <p>Orderan anda Akan Segera kami proses 1x24 Jam Setelah Anda Melakukan Pembayaran ke ATM kami dan menyertakan informasi pribadi yang melakukan pembayaran seperti Nama Pemilik Rekening / Sumber Dana, Tanggal Pembayaran, Metode Pembayaran dan Jumlah Bayar.</p>

        <form method="post">
          <input type="submit" class="form-control btn btn-success" name="checkout" value="I Agree and Check Out" \>
        </form>

      </div>
    </section>
    <!--================ confirmation part end =================-->
  </main>
  <footer>
    <!-- Footer Start-->
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

</body>

</html>