<?php
// include database connection file
include_once("koneksi.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $kategori_sex = $_POST['kategori_sex'];
    $foto_produk = $_POST['foto_produk'];

    // update user data
    $result = mysqli_query($mysqli, "UPDATE tbl_m_produk SET nama_produk='$nama_produk',harga_produk='$harga_produk',kategori_sex='$kategori_sex',foto_produk='$foto_produk' WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: view.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM tbl_m_produk WHERE id=$id");

while ($user_data = mysqli_fetch_array($result)) {
    $nama_produk = $user_data['nama_produk'];
    $harga_produk = $user_data['harga_produk'];
    $kategori_sex = $user_data['kategori_sex'];
    $foto_produk = $user_data['foto_produk'];
}
?>
<html>

<head>
    <title>Edit User Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Nama Produk</td>
                <td><input type="text" name="nama_produk" value=<?php echo $nama_produk; ?>></td>
            </tr>
            <tr>
                <td>Harga Produk</td>
                <td><input type="text" name="harga_produk" value=<?php echo $harga_produk; ?>></td>
            </tr>
            <tr>
                <td>Kategori Sex</td>
                <td><input type="text" name="kategori_sex" value=<?php echo $kategori_sex; ?>></td>
                <td>
                    <select name="kategori_sex">
                        <option value="<?php echo $kategori_sex; ?>"><?php echo $kategori_sex; ?></option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Foto Produk</td>
                <td><input type="file" name="foto_produk" value=<?php echo $foto_produk; ?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>