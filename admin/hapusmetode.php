<?php


// if (!isset($_SESSION["login"])) {
//     header("Location: ../login.php");
//     exit;
// }

require '../functions.php';
$no = $_GET["id"];

if (hapusMetodePembayaran($no) > 0) {
    echo "<script>
        alert('Metode pembayaran berhasil dihapus');
        document.location.href = 'metodepembayaran.php';
        </script>";
} else {
    echo "<script>
        alert('Metode pembayaran gagal dihapus');
        document.location.href = 'metodepembayaran.php';
        </script>";
}
