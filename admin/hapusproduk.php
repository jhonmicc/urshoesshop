<?php


// if (!isset($_SESSION["login"])) {
//     header("Location: ../login.php");
//     exit;
// }

require '../functions.php';
$idproduk = $_GET["id"];


if (hapusProduk($idproduk) > 0) {
    echo "<script>
        alert('produk berhasil dihapus');
        document.location.href = 'produk.php';
        </script>";
} else {
    echo "<script>
        alert('produk gagal dihapus');
        document.location.href = 'produk.php';
        </script>";
}
