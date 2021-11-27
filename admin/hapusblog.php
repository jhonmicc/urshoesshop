<?php


// if (!isset($_SESSION["login"])) {
//     header("Location: ../login.php");
//     exit;
// }

require '../functions.php';
$idblog = $_GET["id"];


if (hapusBlog($idblog) > 0) {
    echo "<script>
        alert('Artikel berhasil dihapus');
        document.location.href = 'blog.php';
        </script>";
} else {
    echo "<script>
        alert('Artikel gagal dihapus');
        document.location.href = 'blog.php';
        </script>";
}
