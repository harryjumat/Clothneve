<?php
include "koneksi.php";
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: view.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($kon, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: view.php");
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clothneve - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <!-- <div class="alert alert-warning" role="alert">
        <?php //echo $_SESSION['error'] 
        ?>
    </div> -->

    <div class="container" style="margin-top:100px;">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow-lg my-5">
                    <div class="card-body">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Clothneve - Login</h1>
                            </div>

                            <!-- FORM -->
                            <form class="login" action="login.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>
                                <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                    Login
                                </a> -->
                                <button name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                            </form>
                            <!-- FORM -->
                            <br>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>