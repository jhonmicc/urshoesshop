<?php


// if (!isset($_SESSION["login"])) {
//     header("Location: ../login.php");
//     exit;
// }

require '../functions.php';
$idkategori = $_GET["id"];

if (hapusKategori($idkategori) > 0) {
    echo "<script>
        alert('kategori berhasil dihapus');
        document.location.href = 'kategoriproduk.php';
        </script>";
} else {
    echo "<script>
        alert('kategori gagal dihapus');
        document.location.href = 'kategoriproduk.php';
        </script>";
}
