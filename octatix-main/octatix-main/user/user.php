<?php

session_start();

require "../koneksi.php";
if (empty($_SESSION['username'])) {
     header("Location: ../error.php");
     exit();
}

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

     <title>OCTATIX - Your tickets solutions</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/magnific-popup.css">
     <link rel="stylesheet" href="../css/font-awesome.min.css">
     <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

     <link rel="stylesheet" href="../css/main-style.css">
</head>

<body>

     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>

     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <a href="user.php" class="navbar-brand"><img height="50px" width="150px"
                              src="../images/octatix-logo.png" alt="LogoTubes"></a>
               </div>

               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li class="section-btn" style="background-color: black;">
                              <a href="../index.php">
                                   Kembali
                              </a>
                         </li>
                         <li class="section-btn">
                              <a class="dropdown-item" href=#" data-toggle="modal" data-target="#logoutModal">
                                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Logout
                              </a>
                         </li>
                         <li class="section-btn" style="background-color: black;">
                              <a href="profile.php?id=<?php echo $_SESSION['id']; ?>">
                                   <?php
                                   echo $_SESSION['nama'];
                                   ?>
                              </a>
                         </li>
                         <li class="section-btn" style="background-color: green">
                              <a href="riwayat.php?username=<?php echo $_SESSION['username']; ?>">
                                   Riwayat Pembelian
                              </a>
                         </li>
                    </ul>
               </div>


          </div>
     </section>

     <section id="data-konser" data-stellar-background-ratio="0.5" style="background-color: white;">
          <br>
          <br>
          <div class="container">
               <div class="row">
                    <div class="col-md-12">
                         <span id="current-time"></span>
                    </div>
               </div>
          </div>
          <div class="container">
               <table id="tabelKonser" class="display">
                    <thead>
                         <tr>
                              <th>Nama Konser</th>
                              <th>Batas Waktu Bayar</th>
                              <th>Harga</th>
                              <th>Stok Tiket</th>
                              <th>Beli Tiket</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         $query = "SELECT * FROM keranjang";
                         $hasil = mysqli_query($koneksi, $query);
                         foreach ($hasil as $data) {
                              ?>
                              <tr?>
                                   <td>
                                        <?php echo $data['nama_konser']; ?>
                                   </td>
                                   <td>
                                        <?php echo $data['waktu']; ?>
                                   </td>
                                   <td>
                                        <?php echo "Rp. " . $data['harga']; ?>
                                   </td>
                                   <td>
                                        <?php echo $data['stok_tiket']; ?>
                                   </td>
                                   <?php
                                   $waktu_database = strtotime($data['waktu']); // Waktu dari database
                                   $waktu_sekarang = time(); // Waktu saat ini
                              
                                   // Cek jika waktu saat ini lebih besar dari waktu pada database
                                   if ($waktu_sekarang > $waktu_database) {
                                        // Jika waktu sudah lewat, tampilkan teks 'Order Timeout'
                                        ?>
                                        <!-- Tampilkan data lainnya -->
                                        <td>
                                             Order Timeout
                                        </td>
                                        <?php
                                   } else {
                                        // Jika waktu belum lewat, tampilkan tombol "Beli Sekarang"
                                        ?>
                                        <!-- Tampilkan data lainnya -->
                                        <td>
                                             <form method="POST" action="checkout.php">
                                                  <input type="text" hidden name="id" value="<?php echo $data['id'] ?>">
                                                  <button type="submit" name="btnBeli" class="btn btn-success">Beli
                                                       Sekarang</button>
                                             </form>
                                        </td>
                                        <?php
                                   }
                                   ?>
                                   </tr>
                                   <?php
                         }
                         ?>

                    </tbody>
               </table>
     </section>

     <!-- FOOTER -->
     <footer data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-5 col-sm-12">
                         <div class="footer-thumb footer-info">
                              <h2>Octatix Company</h2>
                              <p>OCT8TIX aspires to be a pioneer in the global live concert ticket sales sector. Its
                                   inception
                                   was led by a team of indivuals deeply dedicated to music and live performance arts.
                              </p>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-4">
                         <div class="footer-thumb">
                              <h2>Connect</h2>
                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-4">
                         <div class="footer-thumb">
                              <h2>Contact</h2>
                              <ul class="social-icon">
                                   <li>
                                        <p>Octatix@gmail.com</p>
                                   </li>
                                   <li>
                                        <p>085361405700</p>
                                   </li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                         <div class="footer-thumb">
                              <h2>Find us</h2>
                              <p>Teknologi Informasi <br> Universitas Sumatera Utara</p>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                         <div class="footer-bottom">
                              <div class="copyright-text">
                                   <center>
                                        <p>Copyright &copy; 2023 OCTATIX</p>
                                   </center>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </footer>

     <!-- modal logout -->
     <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Ready to Leave?</h5>
                         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                         </button>
                    </div>
                    <div class="modal-body" style="color:white;">Select "Logout" below if you are ready to end your
                         current
                         session.</div>
                    <div class="modal-footer">
                         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                         <a class="btn btn-danger" href="../logout.php">Logout</a>
                    </div>
               </div>
          </div>
     </div>

     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/jquery.stellar.min.js"></script>
     <script src="../js/jquery.magnific-popup.min.js"></script>
     <script src="../js/smoothscroll.js"></script>
     <script src="../js/custom.js"></script>
     <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
     <script>
          let table = new DataTable('#tabelKonser');
     </script>
     <script>
          function updateClock() {
               const now = new Date();
               const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric'
               };
               const currentDateTime = now.toLocaleDateString('en-US', options); // Mengambil waktu lengkap saat ini
               document.getElementById('current-time').textContent = currentDateTime; // Menampilkan waktu lengkap pada elemen span
          }

          // Memanggil fungsi untuk pertama kali saat halaman dimuat
          updateClock();

          // Memperbarui waktu setiap detik
          setInterval(updateClock, 1000);
     </script>

</body>

</html>

<?php ob_end_flush(); ?>