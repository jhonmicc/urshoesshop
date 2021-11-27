<?php
session_start();
include 'functions.php';
error_reporting(0);

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$uid = $_SESSION['id'];
$caricart = mysqli_query($conn, "select * from cart where userid='$uid' and status='Cart'");
$fetc = mysqli_fetch_array($caricart);
$orderidd = $fetc['orderid'];
$itungtrans = mysqli_query($conn, "select count(orderid) as jumlahtrans from cart where userid='$uid' and status!='Cart'");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];

if (isset($_POST["update"])) {
  $kode = $_POST['idproduknya'];
  $jumlah = $_POST['jumlah'];
  $q1 = mysqli_query($conn, "update detailorder set qty='$jumlah' where idproduk='$kode' and orderid='$orderidd'");
  if ($q1) {
    echo "Berhasil Update Cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
  } else {
    echo "Gagal update cart
		<meta http-equiv='refresh' content='1; url= cart.php'/>";
  }
} else if (isset($_POST["hapus"])) {
  $kode = $_POST['idproduknya'];
  $q2 = mysqli_query($conn, "delete from detailorder where idproduk='$kode' and orderid='$orderidd'");
  if ($q2) {
    echo "Berhasil Hapus";
  } else {
    echo "Gagal Hapus";
  }
}


?>

<!doctype html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Urshoesshop | Order List</title>
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
  <!-- DATA TABLES -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
                <h2>Order List</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ confirmation part start =================-->
    <section class="confirmation_part section_padding">
      <div class="container">
        <h3>Kamu memiliki
          <span>
            <?php echo $itungtrans3 ?> transaksi
          </span>
        </h3>
        <table id="kategoriproduk" class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Order</th>
              <th scope="col">Tanggal Order</th>
              <th scope="col">Total</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <?php
          $barang = mysqli_query($conn, "SELECT DISTINCT(idcart), c.orderid, tglorder, status from cart c, detailorder d where c.userid='$uid' and d.orderid=c.orderid and status!='Cart' order by tglorder DESC");
          $no = 1;
          while ($res = mysqli_fetch_array($barang)) {
          ?>
            <tbody>
              <tr>
                <form action="POST">
                  <th scope="row"><?= $no++; ?></th>
                  <td><a style="color: black;" href="order.php?id=<?= $res['orderid']; ?>"><?= $res['orderid']; ?></a></td>
                  <td><?= $res['tglorder']; ?></td>
                  <td>
                    <?php
                    $ongkir = 30000;
                    $ordid = $res['orderid'];
                    $result1 = mysqli_query($conn, "SELECT SUM(qty * harga) + $ongkir AS count FROM detailorder d, produk p 
                    WHERE d.orderid = '$ordid' AND p.idproduk = d.idproduk ORDER BY d.idproduk ASC");
                    $cekrow = mysqli_num_rows($result1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $count = $row1['count'];
                    if ($cekrow > 0) {
                      echo 'Rp ' . number_format($count);
                    } else {
                      echo 'No Data';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if ($res['status'] == 'Payment') {
                      echo '
								<a href="confirmation.php?id=' . $res['orderid'] . '" class="form-control btn-primary">
								Konfirmasi Pembayaran
								</a>
								';
                    } else if ($res['status'] == 'Diproses') {
                      echo 'Pesanan Diproses (Pembayaran Diterima)';
                    } else if ($res['status'] == 'Pengiriman') {
                      echo 'Pesanan Sedang Dikirim';
                    } else if ($res['status'] == 'Selesai') {
                      echo 'Pesanan Selesai';
                    } else if ($res['status'] == 'Dibatalkan') {
                      echo 'Pesanan Dibatalkan';
                    } else {
                      echo 'Konfirmasi diterima';
                    }
                    ?>
                </form>
                </td>
              </tr>
            <?php
          }
            ?>
            </tbody>
        </table>
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

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/scripts/klorofil-common.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#kategoriproduk').DataTable();
    });
  </script>

</body>

</html>