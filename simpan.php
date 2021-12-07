<?php

if (isset($_POST['btn_simpan'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $kategori_sex = $_POST['kategori_sex'];
    //Include file koneksi, untuk koneksikan ke database
    include 'koneksi.php';
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if (!empty($gambar)) {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

                //Mengupload gambar
                move_uploaded_file($file_tmp, 'gambar/' . $gambar);

                $sql = "insert into tbl_m_produk (nama_produk,harga_produk,kategori_sex,foto_produk) values ('$nama_produk','$harga_produk','$kategori_sex','$gambar')";

                $simpan_bank = mysqli_query($kon, $sql);

                if ($simpan_bank) {
                    header("Location:view.php?add=berhasil");
                } else {
                    header("Location:view.php?add=gagal");
                }
            }
        } else {
            $gambar = "bank_default.png";
        }
    }
}
