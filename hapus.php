<?php
include 'koneksi.php';

$id = $_GET["id"];
$foto_produk = $_GET["foto_produk"];
$sql = "delete from tbl_m_produk where id=$id";
$hapus_bank = mysqli_query($kon, $sql);

//Menghapus file gambar
unlink("gambar/" . $foto_produk);

if ($hapus_bank) {
    header("Location:view.php?hapus=berhasil");
} else {
    header("Location:view.php?hapus=gagal");
}
