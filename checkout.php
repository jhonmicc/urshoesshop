<?php
include "functions.php";
session_start();

// if (!isset($_SESSION["login"])) {
//   header("Location: login.php");
//   exit;
// }

$uid = $_SESSION['id'];
$caricart = mysqli_query($conn, "SELECT * FROM cart WHERE userid = '$uid' AND status = 'Cart'");
$fetc = mysqli_fetch_array($caricart);
$orderidd = $fetc['orderid'];
$itungtrans = mysqli_query($conn, "SELECT count(detailid) AS jumlahtrans FROM detailorder WHERE orderid = '$orderidd'");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];


if (isset($_POST["checkout"])) {
  $nama = stripslashes($_POST['nama']);
  $notelp = stripslashes($_POST['notelp']);
  $email = stripslashes($_POST['email']);
  $alamat = stripslashes($_POST['alamat']);
  $kota = stripslashes($_POST['kota']);
  $kodepos = stripslashes($_POST['kodepos']);
  $insertbill = mysqli_query($conn, "INSERT INTO billingdetail (namalengkap, notelp, email, alamat, kota, kodepos) 
    VALUES ('$nama', '$notelp', '$email', '$alamat', '$kota', '$kodepos')");
  if ($insertbill) {
    echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href = 'payment.php';
    </script>";
  } else {
    echo "<script>
    alert('Data gagal ditambahkan!');
    document.location.href = 'checkout.php';
    </script>";
  }
}

// if (isset($_POST["checkout"])) {
//   if (insertBillingDetail($_POST) > 0) {
//     echo "<script>
//         alert('Data gagal ditambahkan');
//         document.location.href = 'checkout.php';
//         </script>";
//   } else {
//     echo "<script>
//         alert('Data berhasil ditambahkan');
//         document.location.href = 'payment.php';
//         </script>";
//   }
// }

?>

<!doctype html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Urshoes Shop | Checkout</title>
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
                <h2>Checkout</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
      <div class="container">
        <div class="returning_customer">

          <div class="billing_details">
            <div class="row">
              <div class="col-lg-6">
                <h3>Billing Details</h3>
                <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="Full name" class="form-control" id="fullname" name="nama" required />
                    <span></span>
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="Number" class="form-control" id="number" name="notelp" required />
                    <span></span>
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="Email" class="form-control" id="email" name="email" required />
                    <span></span>
                  </div>

                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="Address" class="form-control" id="add1" name="alamat" required />
                    <span></span>
                  </div>

                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="City" class="form-control" id="city" name="kota" required />
                    <span></span>
                  </div>
                  <div class="col-md-6 form-group p_star">
                    <input type="text" placeholder="Postcode" class="form-control" id="postcode" name="kodepos" required />
                    <span></span>
                  </div>
                  <div>
                    <button type="submit" value="submit" class="btn_3" name="checkout">
                      Proceed to Payment
                    </button>
                  </div>


                </form>
              </div>
              <div class="col-lg-5">

                <div class="order_box">
                  <h2>Your Order</h2>
                  <ul class="list">
                    <li>
                      <a href="#">Product
                        <span>Total</span>
                      </a>
                    </li>
                    <?php
                    $prdk = mysqli_query($conn, "SELECT * FROM detailorder d, produk p WHERE orderid = '$orderidd' AND d.idproduk = p.idproduk ORDER BY d.idproduk ASC");
                    while ($res = mysqli_fetch_array($prdk)) {

                    ?>
                      <li>
                        <a href="#"> <?= $res['namaproduk']; ?>
                          <span class="middle">x<?= $res['qty']; ?></span>
                          <span class="last">Rp<?= number_format($res['harga']); ?></span>
                        </a>
                      </li>
                    <?php
                    }
                    ?>
                  </ul>

                  <?php
                  $prdk = mysqli_query($conn, "SELECT * FROM detailorder d, produk p WHERE orderid = '$orderidd' AND d.idproduk = p.idproduk ORDER BY d.idproduk ASC");
                  $subtotal = 30000;

                  while ($res = mysqli_fetch_array($prdk)) {
                    $harga = $res['harga'];
                    $qtyy = $res['qty'];
                    $totalharga = $harga * $qtyy;
                    $subtotal += $totalharga;
                  }
                  ?>
                  <ul class="list list_2">
                    <li>
                      <a href="#">Shipping
                        <span>Rp<?= number_format(30000); ?></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">Total
                        <span>Rp<?= number_format($subtotal); ?></span>
                      </a>
                    </li>
                  </ul>
                  <!-- <input type="submit" class="btn_3" value="Proceed to Payment" onclick="location.href='payment.php';" name="checkout"> -->

                  <!-- <a class="btn_3" href="payment.php">Proceed to Payment</a> -->
                </div>

              </div>
            </div>
          </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
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