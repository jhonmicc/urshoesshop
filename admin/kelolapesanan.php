<?php
session_start();
include "../functions.php";

?>

<!doctype html>
<html lang="en">

<head>
	<title>Kelola Pesanan | Urshoes Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- DATA TABLES -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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



			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
						</li>

						<li><a href="kelolapesanan.php" class="active"><i class="lnr lnr-cart"></i> <span>Kelola Pesanan</span></a>
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
				<div class="row">
					<div class="col-md-9">
						<h2>Daftar Pesanan</h2>
					</div>

				</div>
				<table id="kategoriproduk" class="table table-striped">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">ID Pesanan</th>
							<th scope="col">Nama Pelanggan</th>
							<th scope="col">Tanggal Order</th>
							<th scope="col">Total</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$brgs = mysqli_query($conn, "SELECT * from cart c, login l where c.userid=l.id and status!='Cart' and status!='Selesai' order by idcart ASC");
						$no = 1;
						while ($p = mysqli_fetch_array($brgs)) {
							$orderids = $p['orderid'];
						?>

							<tr>
								<td><?php echo $no++ ?></td>
								<td>
									<strong>
										<a href="order.php?orderid=<?php echo $p['orderid'] ?>">#<?php echo $p['orderid'] ?></a>
									</strong>
								</td>
								<td><?php echo $p['namalengkap'] ?></td>
								<td><?php echo $p['tglorder'] ?></td>
								<td>Rp<?php

										$result1 = mysqli_query($conn, "SELECT SUM(d.qty*p.harga) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
										$cekrow = mysqli_num_rows($result1);
										$row1 = mysqli_fetch_assoc($result1);
										$count = $row1['count'];
										if ($cekrow > 0) {
											echo number_format($count);
										} else {
											echo 'No data';
										} ?></td>
								<td><?php

									//echo $p['status'] 
									$orders = $p['orderid'];
									$cekkonfirmasipembayaran = mysqli_query($conn, "select * from konfirmasi where orderid='$orders'");
									$cekroww = mysqli_num_rows($cekkonfirmasipembayaran);

									if ($cekroww > 0) {
										echo 'Confirmed';
									} else {
										if ($p['status'] != 'Pengiriman') {
											echo "Menunggu Konfirmasi";
										} else {
											echo "Pengiriman";
										};
									}

									?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
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