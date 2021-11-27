<?php
include "../functions.php";

if (isset($_POST['addproduct'])) {
	if (tambahProduk($_POST) > 0) {
		echo "<script>
        alert('data gagal ditambahkan');
        document.location.href = 'produk.php';
        </script>";
	} else {
		echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'produk.php';
        </script>";
	}
}


?>

<!doctype html>
<html lang="en">

<head>
	<title>Produk | Urshoes Admin</title>
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

						<li><a href="kelolapesanan.php" class=""><i class="lnr lnr-cart"></i> <span>Kelola Pesanan</span></a>
						</li>

						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i>
								<span>Kelola Toko</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="kategoriproduk.php" class="">Kategori Produk</a></li>
									<li><a href="produk.php" class="active">Produk</a></li>
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
						<h2>Daftar Produk</h2>
					</div>
					<div>
						<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Produk</button>
					</div>
				</div>
				<table id="produk" class="table table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Gambar</th>
							<th>Nama Produk</th>
							<th>Kategori</th>
							<th>Deskripsi</th>
							<th>Harga</th>
							<th>Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$prdk = mysqli_query($conn, "SELECT * FROM kategori k, produk p WHERE k.idkategori=p.idkategori ORDER BY idproduk ASC");
						$no = 1;
						while ($p = mysqli_fetch_array($prdk)) {

						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><img src="../assets/img/gallery/<?= $p['gambar'] ?>" width="40%"></td>
								<td><?= $p['namaproduk'] ?></td>
								<td><?= $p['namakategori'] ?></td>
								<td><?= $p['deskripsi'] ?></td>
								<td>Rp<?= number_format($p['harga']); ?></td>
								<td><?= $p['tgldibuat'] ?></td>
								<td>
									<a class="btn btn-info" href="updateproduk.php?id=<?= $p["idproduk"]; ?>"><i class="fa fa-edit"></i>Edit</a>
									<a class="btn btn-danger" href="hapusproduk.php?id=<?= $p["idproduk"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus ?');"><i class="fa fa-remove"></i>Hapus</a>
								</td>
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
				<p class="copyright">&copy; 2017 <a href="../index.php" target="_blank">Urshoes Shop</a>.
					All Rights Reserved.</p>
			</div>
		</footer>
	</div>

	<!-- modal input -->
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Produk</h4>
				</div>

				<div class="modal-body">
					<form action="produk.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Produk</label>
							<input name="namaproduk" type="text" class="form-control" required autofocus>
						</div>
						<div class="form-group">
							<label>Nama Kategori</label>
							<select name="idkategori" class="form-control" required>
								<option selected>Pilih Kategori</option>
								<?php
								$det = mysqli_query($conn, "SELECT * FROM kategori ORDER BY namakategori ASC") or die(mysqli_error($conn));
								while ($d = mysqli_fetch_array($det)) {
								?>
									<option value="<?= $d['idkategori'] ?>"><?= $d['namakategori'] ?></option>
								<?php
								}
								?>
							</select>

						</div>
						<div class="form-group">
							<label>Deskripsi</label>
							<input name="deskripsi" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input name="harga" type="number" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Gambar</label>
							<input name="gambar" type="file" class="form-control" required>
						</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input name="addproduct" type="submit" class="btn btn-primary" value="Tambah">
				</div>
			</div>
		</div>
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
			$('#produk').DataTable();
		});
	</script>
</body>

</html>