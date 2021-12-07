<html>

<head>
    <title>Add Users</title>
</head>

<body>
    <a href="index.php">Go to Home</a>
    <br /><br />
    <form action="input.php" method="post" name="form1">
        <table width="25%">
            <tr>
                <td>Nama Produk</td>
                <td><input type="text" name="nama_produk"></td>
            </tr>
            <tr>
                <td>Harga Produk</td>
                <td><input type="text" name="harga_produk"></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>
                    <select name="kategori_sex">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Foto Produk</td>
                <td><input type="file" name="foto_produk"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $kategori_sex = $_POST['kategori_sex'];
        $foto_produk = $_POST['foto_produk'];

        // include database connection file
        include_once("koneksi.php");

        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO tbl_m_produk(nama_produk,harga_produk,kategori_sex,foto_produk) VALUES('$nama_produk','$harga_produk','$kategori_sex','$foto_produk')");

        // Show message when user added
        //echo "User added successfully. <a href='index.php'>View Users</a>";
    }
    ?>
</body>

</html>