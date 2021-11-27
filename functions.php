<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "urshoesshop");

if (!$conn) {
    die("Koneksi dengan MySQL gagal");
} else {
};

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $conn;

    $namalengkap = stripslashes($data["namalengkap"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $notelp = stripslashes($data["notelp"]);
    $alamat = stripslashes($data["alamat"]);

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke databse
    mysqli_query($conn, "INSERT INTO login VALUES('', '$namalengkap', '$email', '$password', '$notelp', '$alamat', '', '', '')");

    return mysqli_affected_rows($conn);
}

function upload()
{
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $error_file = $_FILES['gambar']['error'];

    // cek apakah ada gambar yg diupload
    if ($error_file === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!')</script>";
        return false;
    }

    // cek apakah file yang diupload adalah gambar
    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $nama_file);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang anda UPLOAD bukan gambar !!')</script>";
        return false;
    }

    if ($ukuran_file > 10000000) {
        echo "<script>alert('Ukuran gambar terlalu BESAR!!!')</script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmp_file, 'C:/xampp/htdocs/urshoesshop/assets/img/gallery/' . $namaFileBaru);
    return $namaFileBaru;
}

function uploadBlog()
{
    $nama_file = $_FILES['gambarblog']['name'];
    $ukuran_file = $_FILES['gambarblog']['size'];
    $tmp_file = $_FILES['gambarblog']['tmp_name'];
    $error_file = $_FILES['gambarblog']['error'];

    // cek apakah ada gambar yg diupload
    if ($error_file === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!')</script>";
        return false;
    }

    // cek apakah file yang diupload adalah gambar
    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $nama_file);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang anda UPLOAD bukan gambar !!')</script>";
        return false;
    }

    if ($ukuran_file > 10000000) {
        echo "<script>alert('Ukuran gambar terlalu BESAR!!!')</script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmp_file, 'C:/xampp/htdocs/urshoesshop/assets/img/blog/' . $namaFileBaru);
    return $namaFileBaru;
}

function tambahProduk()
{
    global $conn;
    $idkategori = $_POST['idkategori'];
    $namaproduk = $_POST['namaproduk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $tambahproduk = mysqli_query($conn, "INSERT INTO produk (idkategori, namaproduk, gambar, deskripsi, harga) 
				VALUES ('$idkategori', '$namaproduk', '$gambar', '$deskripsi', '$harga')");

    if ($tambahproduk) {
        echo "<meta http-equiv='refresh' content='0; url= produk.php'/>  ";
    } else {
        echo "<meta http-equiv='refresh' content='0; url= produk.php'/>  ";
    }
};

function tambahKategori()
{
    global $conn;
    $namakategori = $_POST['namakategori'];
    $tambahkat = mysqli_query($conn, "INSERT INTO kategori (namakategori) VALUES ('$namakategori')");
    if ($tambahkat) {
        echo "<meta http-equiv='refresh' content='0; url= kategoriproduk.php'/>  ";
    } else {
        echo "<meta http-equiv='refresh' content='0; url= kategoriproduk.php'/> ";
    }
}

function tambahMetodePembayaran()
{
    global $conn;
    $no = $_POST['no'];
    $namametode = $_POST['metode'];
    $norek = $_POST['norek'];
    $logo = $_POST['logo'];
    $atasnama = $_POST['an'];
    $tambahmet = mysqli_query($conn, "INSERT INTO metodepembayaran (no, metode, norek, logo, an) 
    VALUES ('$no', '$namametode', '$norek', '$logo', '$atasnama')");
    if ($tambahmet) {
        echo "<meta http-equiv='refresh' content='0; url= metodepembayaran.php'/>  ";
    } else {
        echo "<meta http-equiv='refresh' content='0; url= metodepembayaran.php'/>  ";
    }
}

function tambahBlog()
{
    global $conn;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $urlblog = $_POST['urlblog'];

    // upload gambar
    $gambarblog = uploadBlog();
    if (!$gambarblog) {
        return false;
    }

    $tambahblog = mysqli_query($conn, "INSERT INTO blog (idblog, title, gambarblog, content, urlblog)
				VALUES ('', '$title', '$gambarblog', '$content', '$urlblog')");

    if ($tambahblog) {
        echo "<meta http-equiv='refresh' content='0; url= blog.php'/>  ";
    } else {
        echo "<meta http-equiv='refresh' content='0; url= blog.php'/>  ";
    }
};

function updateKategori($kategori)
{
    global $conn;
    $id = $kategori["idkategori"];
    $namakategori = htmlspecialchars($kategori["namakategori"]);

    // semua data ditimpa dengan data yg baru meskipun ditimpa dengan data yang lama
    $query = "UPDATE kategori SET namakategori = '$namakategori' WHERE idkategori = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateProduk($produk)
{
    global $conn;
    $id = $produk["idproduk"];
    $namaproduk = htmlspecialchars($produk["namaproduk"]);
    $deskripsi = htmlspecialchars($produk["deskripsi"]);
    $harga = htmlspecialchars($produk["harga"]);
    $gambarLama = htmlspecialchars($produk["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // semua data ditimpa dengan data yg baru meskipun ditimpa dengan data yang lama
    $query = "UPDATE produk SET namaproduk = '$namaproduk', deskripsi = '$deskripsi', harga = '$harga', gambar = '$gambar' WHERE idproduk = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateMetode($metode)
{
    global $conn;
    $no = $metode["no"];
    $namametode = htmlspecialchars($metode["metode"]);
    $norek = htmlspecialchars($metode["norek"]);
    $an = htmlspecialchars($metode["an"]);
    $logo = htmlspecialchars($metode["logo"]);

    // SEMUA DATA DITIMPA DENGAN DATA YANG BARU MESKIPUN DITIMPA DENGAN DATA YANG LAMA
    $query = "UPDATE metodepembayaran SET metode = '$namametode', norek = '$norek', an = '$an', logo = '$logo' WHERE no = $no";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateBlog($blog)
{
    global $conn;
    $idblog = $blog["idblog"];
    $title = htmlspecialchars($blog["title"]);
    $content = htmlspecialchars($blog["content"]);
    $urlblog = htmlspecialchars($blog["urlblog"]);
    $gambarLama = htmlspecialchars($blog["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambarblog']['error'] === 4) {
        $gambarblog = $gambarLama;
    } else {
        $gambarblog = uploadBlog();
    }

    // semua data ditimpa dengan data yg baru meskipun ditimpa dengan data yang lama
    $query = "UPDATE blog SET title = '$title', content = '$content', urlblog = '$urlblog', gambarblog = '$gambarblog' WHERE idblog = $idblog";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusKategori($idkategori)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kategori WHERE idkategori = $idkategori");
    return mysqli_affected_rows($conn);
}

function hapusProduk($idproduk)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE idproduk = $idproduk");
    return mysqli_affected_rows($conn);
}


function hapusMetodePembayaran($no)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM metodepembayaran WHERE no = $no");
    return mysqli_affected_rows($conn);
}

function hapusBlog($idblog)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM blog WHERE idblog = $idblog");
    return mysqli_affected_rows($conn);
}
