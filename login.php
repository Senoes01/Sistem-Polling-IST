<?php
@session_start();
include 'config/connection.php';

if (isset($_POST['sigin'])) {
    // Mengamankan input dari SQL Injection
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    // Cek di tabel user terlebih dahulu
    $sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $query = mysqli_query($con, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if ($data['level'] == 'admin') {
            $_SESSION['logged'] = 1;
        } elseif ($data['level'] == 'operator') {
            $_SESSION['logged'] = 2;
        } else {
            $_SESSION['logged'] = null;
        }

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['name'] = $data['nama'];

        echo "<script>alert('Login berhasil!');window.location.href='index.php'</script>";
        exit();
    } else {
        // Menggunakan NIP sebagai Username dan nama_karyawan sebagai Password
        $sql_karyawan = "SELECT * FROM karyawan WHERE NIP='$user' AND nama_karyawan='$pass'";
        $query_karyawan = mysqli_query($con, $sql_karyawan);

        if ($query_karyawan && mysqli_num_rows($query_karyawan) > 0) {
            $data_karyawan = mysqli_fetch_assoc($query_karyawan);

            $_SESSION['logged'] = 2;
            $_SESSION['id_user'] = $data_karyawan['NIP'];
            $_SESSION['name'] = $data_karyawan['nama_karyawan'];

            echo "<script>alert('Login berhasil!');window.location.href='index.php'</script>";
            exit();
        } else {
            echo "<script>alert('NIP atau Nama Karyawan salah!')</script>";
        }
    }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Polling</title>
  <link rel="shortcut icon" href="assets/img/logo bps.png" type="image/x-icon">
  <link rel="icon" href="assets/img/logo bps.png" type="image/x-icon">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <div class="login-logo">
      <img src="assets/img/logo bps.png" width="300px">
    </div>
    <p style="text-align: center; font-family: Arial, Helvetica, sans-serif;">Sistem Seleksi Insan Statistik Teladan ( IST )</p>
    <p style="margin-bottom: 10px; text-align: center; font-family: Arial, Helvetica, sans-serif;">Kabupaten Madiun</p>
    <div style="margin-top: 10px; font-family: Arial, Helvetica, sans-serif;">
            <p href="index.php">Silahkan Login</p>
    </div>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="sigin">Masuk</button>
          <div style="margin-top: 10px;">
            <a href="index.php">Kembali ke Halaman utama?</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>
