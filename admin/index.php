<?php
session_start();
include '../functions.php';

$itungcust = mysqli_query($conn, "SELECT count(id) as jumlahcust FROM login WHERE role='Buyer'");
$itungcust2 = mysqli_fetch_assoc($itungcust);
$itungcust3 = $itungcust2['jumlahcust'];

$itungorder = mysqli_query($conn, "SELECT count(idcart) as jumlahorder FROM cart WHERE status NOT LIKE 'Selesai' AND status NOT LIKE 'Canceled' AND status NOT LIKE 'Cart'");
$itungorder2 = mysqli_fetch_assoc($itungorder);
$itungorder3 = $itungorder2['jumlahorder'];

$itungtrans = mysqli_query($conn, "SELECT count(orderid) as jumlahtrans FROM konfirmasi");
$itungtrans2 = mysqli_fetch_assoc($itungtrans);
$itungtrans3 = $itungtrans2['jumlahtrans'];

?>

<!doctype html>
<html lang="en">

<head>
	<title>Dashboard | Urshoes Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">

			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div class="navbar-btn navbar-btn-right">
					<h4>
						<div class="date">
							<script type='text/javascript'>
								var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
								var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
								var date = new Date();
								var day = date.getDate();
								var month = date.getMonth();
								var thisDay = date.getDay(),
									thisDay = myDays[thisDay];
								var yy = date.getYear();
								var year = (yy < 1000) ? yy + 1900 : yy;
								document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
							</script>
						</div>
					</h4>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
						</li>

						<li><a href="kelolapesanan.php" class=""><i class="lnr lnr-cart"></i> <span>Kelola Pesanan</span></a>
						</li>

						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i>
								<span>Kelola Toko</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="kategoriproduk.php" class="">Kategori Produk</a></li>
									<li><a href="produk.php" class="">Produk</a></li>
									<li><a href="metodepembayaran.php" class="">Metode Pembayaran</a></li>
								</ul>
							</div>
						</li>
						<li><a href="kelolapelanggan.php" class=""><i class="lnr lnr-users"></i> <span>Kelola
									Pelanggan</span></a></li>
						<li><a href="kelolastaff.php" class=""><i class="lnr lnr-user"></i>
								<span>Kelola Staff</span></a></li>
						<li><a href="blog.php" class=""><i class="lnr lnr-file-add"></i>
								<span>Blog</span></a></li>
						<li><a href="../login.php" class=""><i class="lnr lnr-power-switch"></i>
								<span>Logout</span></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Weekly Overview</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-users"></i></span>
										<p>
											<span class="number"><?= $itungcust3; ?></span>
											<span class="title">Pelanggan</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-shopping-bag"></i></span>
										<p>
											<span class="number"><?= $itungorder3; ?></span>
											<span class="title">Pesanan</span>
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<span class="icon"><i class="fa fa-check-square-o"></i></span>
										<p>
											<span class="number"><?= $itungtrans3; ?></span>
											<span class="title">Konfirmasi Pembayaran</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
					<div class="row">
						<div class="col-md-6">
							<!-- RECENT PURCHASES -->
							<!-- <div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Purchases</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Order No.</th>
												<th>Name</th>
												<th>Amount</th>
												<th>Date &amp; Time</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">142</th>
												<td>Mark</td>
												<td>Rp 450.000</td>
												<td>5 Mei 2021</td>
												<td>Diterima</td>
											</tr>
											<tr>
												<th scope="row">143</th>
												<td>Lucas</td>
												<td>Rp 300.000</td>
												<td>5 Mei 2021</td>
												<td>Diantar</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i>
												Last 24 hours</span></div>
										<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All
												Purchases</a></div>
									</div>
								</div>
							</div> -->
							<!-- END RECENT PURCHASES -->
						</div>
						<div class="col-md-5">

						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 <a href="../index.php" target="_blank">Urshoes Shop</a>.
					All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<script>
		$(function() {
			var data, options;

			// headline charts
			data = {
				labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
				series: [
					[23, 29, 24, 40, 25, 24, 35],
					[14, 25, 18, 34, 29, 38, 44],
				]
			};

			options = {
				height: 300,
				showArea: true,
				showLine: false,
				showPoint: false,
				fullWidth: true,
				axisX: {
					showGrid: false
				},
				lineSmooth: false,
			};

			new Chartist.Line('#headline-chart', data, options);


			// visits trend charts
			data = {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				series: [{
					name: 'series-real',
					data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
				}, {
					name: 'series-projection',
					data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
				}]
			};

			options = {
				fullWidth: true,
				lineSmooth: false,
				height: "270px",
				low: 0,
				high: 'auto',
				series: {
					'series-projection': {
						showArea: true,
						showPoint: false,
						showLine: false
					},
				},
				axisX: {
					showGrid: false,

				},
				axisY: {
					showGrid: false,
					onlyInteger: true,
					offset: 0,
				},
				chartPadding: {
					left: 20,
					right: 20
				}
			};

			new Chartist.Line('#visits-trends-chart', data, options);


			// visits chart
			data = {
				labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
				series: [
					[6384, 6342, 5437, 2764, 3958, 5068, 7654]
				]
			};

			options = {
				height: 300,
				axisX: {
					showGrid: false
				},
			};

			new Chartist.Bar('#visits-chart', data, options);


			// real-time pie chart
			var sysLoad = $('#system-load').easyPieChart({
				size: 130,
				barColor: function(percent) {
					return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 -
						percent / 100)) + ", 0)";
				},
				trackColor: 'rgba(245, 245, 245, 0.8)',
				scaleColor: false,
				lineWidth: 5,
				lineCap: "square",
				animate: 800
			});

			var updateInterval = 3000; // in milliseconds

			setInterval(function() {
				var randomVal;
				randomVal = getRandomInt(0, 100);

				sysLoad.data('easyPieChart').update(randomVal);
				sysLoad.find('.percent').text(randomVal);
			}, updateInterval);

			function getRandomInt(min, max) {
				return Math.floor(Math.random() * (max - min + 1)) + min;
			}

		});
	</script>
</body>

</html>