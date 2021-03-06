<?php
include_once("koneksi.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: view.php");
}

//Ucapan Selamat
//ubah timezone menjadi jakarta
date_default_timezone_set("Asia/Jakarta");

//ambil jam dan menit
$jam = date('H:i');

//atur salam menggunakan IF
if ($jam > '05:30' && $jam < '10:00') {
    $salam = 'Pagi';
} elseif ($jam >= '10:00' && $jam < '15:00') {
    $salam = 'Siang';
} elseif ($jam < '18:00') {
    $salam = 'Sore';
} else {
    $salam = 'Malam';
}
?>

<html>

<head>
    <title>Admin</title>
    <!-- <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <link rel="icon" type="image/png" href="images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script src="js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <img src="images/icons/chanza_store.png" width="250" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="index.php"><?php echo "Selamat " . $salam .  ", " . $_SESSION['username'] . "!"; ?></a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>
                            <!-- <li class="active-menu">
                                <a href="#">View</a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <div class="container" style="margin-top: 100px;">
        <?php
        //Validasi untuk menampilkan pesan pemberitahuan
        if (isset($_GET['add'])) {

            if ($_GET['add'] == 'berhasil') {
                echo "<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah diupload!</div>";
            } else if ($_GET['add'] == 'gagal') {
                echo "<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal diupload!</div>";
            }
        }

        if (isset($_GET['hapus'])) {

            if ($_GET['hapus'] == 'berhasil') {
                echo "<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah dihapus!</div>";
            } else if ($_GET['hapus'] == 'gagal') {
                echo "<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal dihapus!</div>";
            }
        }
        ?>
        <div class="card" style="padding:25px" style="background-color: #EBECEC;">
            <div id="msg"></div>
            <form action="simpan.php" method="post" enctype="multipart/form-data">


                <div class="form-group col-md-4">
                    <label>Nama</label>
                    <input class="form-control" type="text" name="nama_produk">
                </div>
                <div class="form-group col-md-4">
                    <label>Harga</label>
                    <input class="form-control" type="text" name="harga_produk">
                </div>
                <div class="form-group col-md-4">
                    <label>Kategori</label>
                    <select class="form-control" type="text" name="kategori_sex">
                        <option value="" selected disabled hidden>- Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Foto</label>
                    <img src="images/blank_default.png" id="preview" class="img-thumbnail" width="100px">
                    <input type="file" name="gambar" class="file">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                        <div class="input-group-append">
                            <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" name="btn_simpan" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" width='20%' cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Kategori</th>
                                <th width='10%'>Foto Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // include database
                            include 'koneksi.php';
                            // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                            $sql = "select * from tbl_m_produk";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['nama_produk'] ?></td>
                                    <td><?php echo $data['harga_produk'] ?></td>
                                    <td><?php echo $data['kategori_sex'] ?></td>
                                    <td><img src="gambar/<?php echo $data['foto_produk']; ?>" class="rounded" width='100%' alt="Gambar tidak ada"></td>
                                    <td><a href="hapus.php?id=<?php echo $data['id']; ?>&gambar=<?php echo $data['foto_produk']; ?>" onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a></td>
                                </tr>
                                <!-- bagian akhir (penutup) while -->
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>








    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Wanita">
                        Wanita
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Pria">
                        Pria
                    </button>
                </div>
            </div>

            <div class="row isotope-grid">
                <!-- DARI DATA BASE  -->
                <?php
                include 'koneksi.php';
                // perintah sql untuk menampilkan daftar
                $sql = "select * from tbl_m_produk";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                //Menampilkan data dengan perulangan while
                while ($data = mysqli_fetch_array($hasil)) :
                    $no++;
                ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $data['kategori_sex'] ?>">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="row">
                                <div class="block2-pic hov-img0">
                                    <!-- style nya untuk crop gambar -->
                                    <img src="gambar/<?php echo $data['foto_produk']; ?>" style="width: 260px; height: 337px; object-fit: cover;">
                                    <a href="product-detail.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Quick View
                                    </a>
                                </div>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?php echo $data['nama_produk'] ?>
                                    </a>

                                    <span class="stext-105 cl3">
                                        Rp. <?php echo $data['harga_produk'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- DARI DATA BASE  -->
            </div>
        </div>
        </div>
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>
        </div>
    </section>














    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
    <script>
        function konfirmasi() {
            konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
            document.writeln(konfirmasi)
        }

        $(document).on("click", "#pilih_gambar", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').php();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').php();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').php();
            $(this).on('click', function() {
                swal(nameProduct, "is added to cart !", "success");
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>