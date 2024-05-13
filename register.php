<?php
include 'koneksidb.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256
    $nama = $_POST['nama'];
    $level = 'user';

    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($db, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (username, password, nama, level)
                    VALUES ('$username', '$password', '$nama', '$level')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                echo "<script>window.alert('Selamat, registrasi berhasil!'); window.location.href='login.php';</script>";
                $nama = "";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script> window.alert('Woops! Terjadi kesalahan.'); window.location.href='register.php';</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
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

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
    <div class="row justify-content-center">

    <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat akun</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                        <input type="username" class="form-control form-control-user" name="nama"
                                            placeholder="Fullname" required>
                                   
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="username"
                                        placeholder="Username" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="cpassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                <button name="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </div>
                                
                               <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
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