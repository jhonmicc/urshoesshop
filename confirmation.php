<?php
include 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$idorder = $_GET['id'];

if (isset($_POST['confirm'])) {

  $userid = $_SESSION['id'];
  $veriforderid = mysqli_query($conn, "SELECT * FROM cart WHERE orderid='$idorder'");
  $fetch = mysqli_fetch_array($veriforderid);
  $liat = mysqli_num_rows($veriforderid);

  if ($fetch > 0) {
    $nama = $_POST['nama'];
    $metode = $_POST['metode'];
    $tanggal = $_POST['tanggal'];

    $kon = mysqli_query($conn, "INSERT INTO konfirmasi (orderid, userid, payment, namarekening, tglbayar)
		VALUES('$idorder','$userid','$metode','$nama','$tanggal')");
    if ($kon) {

      $up = mysqli_query($conn, "UPDATE cart SET status='Confirmed' WHERE orderid='$idorder'");

      echo " <div class='alert alert-success'>
			Terima kasih telah melakukan konfirmasi, team kami akan melakukan verifikasi.
		  </div>
		<meta http-equiv='refresh' content='3; url= index.php'/>  ";
    } else {
      echo "<div class='alert alert-warning'>
			Gagal Submit, silakan ulangi lagi.
		  </div>
		 <meta http-equiv='refresh' content='3; url= confirmation.php'/> ";
    }
  } else {
    echo "<div class='alert alert-danger'>
			Kode Order tidak ditemukan, harap masukkan kembali dengan benar
		  </div>
		 <meta http-equiv='refresh' content='4; url= konfirmasi.php'/> ";
  }
};
?>

<!doctype html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Urshoesshop | Confirmation</title>
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
                <h2>Confirmation</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ confirmation part start =================-->
    <div class="register">
      <div class="container">
        <div class="login-form-grids">
          <br><br><br>
          <form method="post">
            <fieldset disabled>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">
                  <h4>Kode Order</h4>
                </label>
                <strong>
                  <input type="text" id="disabledTextInput" class="form-control" name="orderid" value="<?php echo $idorder ?>">
                </strong>
              </div>
            </fieldset>
            <div class="mb-3">
              <h4>Informasi Pembayaran</h4>
              <input class="form-control" type="text" name="nama" placeholder="Nama Pemilik Rekening / Sumber Dana" aria-label="default input example" required>
            </div>
            <div class="mb-3">
              <h4>Rekening Tujuan</h4>
              <select name="metode" class="form-select">
                <?php
                $metode = mysqli_query($conn, "SELECT * FROM metodepembayaran");
                while ($a = mysqli_fetch_array($metode)) {
                ?>
                  <option value="<?php echo $a['metode'] ?>"><?php echo $a['metode'] ?> | <?php echo $a['norek'] ?></option>
                <?php
                };
                ?>
              </select>
            </div>
            <div class="mb-3">
              <br><br>
              <h4>Tanggal Bayar</h4>
              <input type="date" class="form-control" name="tanggal">

            </div>
            <div>
              <a class="btn btn-primary" href="orderlist.php" role="button">Batal</a>
              <input type="submit" name="confirm" class="btn btn-primary" value="Kirim">
            </div>
          </form>

        </div>
      </div>
    </div>
    <!-- //confirmation -->
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

</body>

</html>