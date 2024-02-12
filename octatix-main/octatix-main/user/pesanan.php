<?php
session_start();

require "../koneksi.php";
if (empty($_SESSION['username'])) {
    header("Location: ../error.php");
    exit();
}
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
                        <a href="user.php">
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
                </ul>
            </div>

        </div>
    </section>

    <section id="blog" data-stellar-background-ratio="0.5">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-popup">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Tempat untuk menampilkan informasi pesanan -->
                            <div id="infoTiket">
                                <h2 class="modal-title">Keranjang</h2>
                                <?php
                                if (isset($_POST['btnPesan'])) {
                                    // Ambil data dari form
                                    $idTiket = $_POST['id_tiket'];
                                    $jumlahTiket = $_POST['jumlahTiket'];
                                    $status = 'pending';

                                    // Query untuk mengambil data tiket dari database
                                    $query = "SELECT * FROM keranjang WHERE id = '$idTiket'";
                                    $result = mysqli_query($koneksi, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $username = $_SESSION['username'];
                                        $namaKonser = $row['nama_konser'];
                                        $hargaTiket = $row['harga']; // Sesuaikan dengan nama kolom harga di tabel
                                
                                        // Hitung total harga
                                        $totalHarga = $hargaTiket * $jumlahTiket;

                                        // Tampilkan informasi pesanan
                                        echo "<div class='tab-content'>";
                                        echo "<p>Username: $username</p>";
                                        echo "<p>Nama Konser: $namaKonser</p>";
                                        echo "<p>Quantity: $jumlahTiket</p>";
                                        echo "<p>Total Harga: Rp. $totalHarga</p>";

                                        // Form untuk mengupload gambar
                                        echo "<form method='post' enctype='multipart/form-data' action='upload.php'>";
                                        echo "<input type='hidden' name='id_tiket' id='id_tiket' value='$idTiket'>";
                                        echo "<input type='hidden' name='jumlahTiket' id='jumlahTiket' value='$jumlahTiket'>";
                                        echo "<input type='hidden' name='status' id='status' value='$status'>";
                                        echo "<label for='gambar' style='color: white; align-text: center;'>Upload Bukti Transfer (JPG): </label>";
                                        echo "<input style='color: white; margin: 0 0 10px 20px' class='btn btn-primary' type='file' name='gambar' id='gambar'>";
                                        echo "<button type='submit' class='btn btn-danger' name='btnUpload'>Upload</button>";
                                        echo "</form>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="col-md-5 col-sm-12">
                    <div class="footer-thumb footer-info">
                        <h2>Octatix Company</h2>
                        <p>OCT8TIX aspires to be a pioneer in the global live concert ticket sales sector. Its
                            inception was led by a team of individuals deeply dedicated to music and live
                            performance arts.</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Connect</h2>
                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-facebook-square"
                                    attr="facebook icon"></a></li>
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
                                <p>Copyright &copy; 2023 Octatix</p>
                            </center>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

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
                    current session.</div>
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

</body>

</html>