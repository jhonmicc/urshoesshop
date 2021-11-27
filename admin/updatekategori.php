 <?php
    require '../functions.php';
    // session_start();
    // if (!isset($_SESSION["login"])) {
    //     header("Location: ../login.php");
    //     exit;
    // }

    //AMBIL DATA DI URL
    $idkategori = $_GET["id"];
    //  query data kategori berdasarkan idkategori
    $ktgr = query("SELECT * FROM kategori WHERE idkategori = $idkategori")[0];
    // cek apakah tombol submit sudah pernah ditekan atau belum
    if (isset($_POST["submit"])) {
        // CEK APAKAH DATA BERHASIL DIUBAH ATAU TIDAK
        if (updateKategori($_POST) > 0) {
            echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'kategoriproduk.php';
        </script>";
        } else {
            echo "<script>
        alert('data gagal diubah');
        document.location.href = 'kategoriproduk.php';
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
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <!------ Include the above in your HEAD tag ---------->
     <!-- ICONS -->
     <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
     <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

     <title>Edit</title>
     <style>
         body {
             background: -webkit-linear-gradient(left, #8EC5FC, #E0C3FC);
         }

         .contact-form {
             background: #fff;
             margin-top: 10%;
             margin-bottom: 5%;
             width: 70%;
         }

         .contact-form .form-control {
             border-radius: 1rem;
         }

         .contact-image {
             text-align: center;
         }

         .contact-image img {
             border-radius: 6rem;
             width: 11%;
             margin-top: -3%;

         }

         .contact-form form {
             padding: 14%;
         }

         .contact-form form .row {
             margin-bottom: -7%;
         }

         .contact-form h3 {
             margin-bottom: 8%;
             margin-top: -10%;
             text-align: center;
             color: #0062cc;
         }

         .contact-form .btnContact {
             width: 50%;
             border: none;
             border-radius: 1rem;
             padding: 1.5%;
             background: #dc3545;
             font-weight: 600;
             color: #fff;
             cursor: pointer;
         }

         .btnContactSubmit {
             width: 50%;
             border-radius: 1rem;
             padding: 1.5%;
             color: #fff;
             background-color: #0062cc;
             border: none;
             cursor: pointer;
         }
     </style>
 </head>

 <body>
     <div class="container contact-form">
         <div class="contact-image">
             <img src="../assets/img/favicon/android-chrome-512x512.png" />
         </div>
         <form action="" method="post">
             <input type="hidden" name="idkategori" value="<?= $ktgr["idkategori"]; ?>">
             <h3>Edit Data Kategori</h3>
             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                         <input type="text" name="namakategori" class="form-control" value="<?= $ktgr["namakategori"]; ?>" />
                     </div>
                     <div class="form-group">
                         <input type="submit" name="submit" class="btnContact" value="Edit" />
                     </div>
                 </div>
             </div>
         </form>
     </div>
 </body>

 </html>