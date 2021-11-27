<?php
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

//JIKA TOMBOL CARI DIKLIK, $mahasiswa ditimpa dengan data pencarian
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>


<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>
    <!-- kalo isi action kosong, maka data akan dikirimkan kembali ke halaman ini -->
    <!-- method menentukan apakah datanya akan ditampilkan di URL or tidak -->

    <form action="" method="post">
        <input type="text" name="keyword" placeholder="Cari..." size="60" autofocus autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm
                    ('Apakah anda yakin ingin menghapus ?');">hapus</a>
                </td>
                <td><img src="img/<?php echo $row["gambar"]; ?>" width="50" alt=""></td>
                <td><?php echo $row["nim"]; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["jurusan"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>