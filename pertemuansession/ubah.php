<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//AMBIL DATA DI URL
$id = $_GET["id"];

//  query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah pernah ditekan atau belum
if (isset($_POST["submit"])) {
    // CEK APAKAH DATA BERHASIL DIUBAH ATAU TIDAK
    if (ubah($_POST) > 0) {
        echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah');
        document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Edit data mahasiswa</h2>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?> ">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="nim">NIM :</label>
                <input type="text" name="nim" id="nim" value="<?= $mhs["nim"]; ?>">
            </li>

            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="text" name="gambar" id="gambar" value="<?= $mhs["gambar"]; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Edit Data!</button>
            </li>
        </ul>

    </form>

</body>

</html>