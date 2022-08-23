<?php
include "koneksi.php";
include "Proses_Register.php";
if (isset($_POST["register"])) {

  if (register($_POST) > 0) {
    echo "<script>
            alert('user baru berhasil ditambahkan');
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-6.1.1-web/css/all.min.css">
  <link rel="icon" href="img/logo_smp_preview_rev_1.png" type="image/gif" sizes="16x16">
  <title>Form Pendaftaran</title>
</head>

<body style="background-color: dodgerblue;">

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  <div class="register">

    <form action="" method="post">

      <div class="container">
        <img src="img/logo_smp_preview_rev_1.png" alt="Avatar" class="avatar" width="25%">
        <h1>Pendaftaran</h1>
        <p>Silahkan Diisi Untuk Pendaftaran Akun Koperasi</p>
        <hr>

        <label for="Username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id="username" required><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required><br>

        <label for="password2"><b>Konfirmasi Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password2" id="password2" required>
        <hr>

        <button type="submit" class="registerbtn gradient-custom-4" name="register"><b>Register</b></button>

        <div class="container signin">
          <p>Sudah Mempunyai Akun? <a href="login.php">Sign in</a>.</p>
        </div>
      </div>
    </form>
  </div>

</body>

</html>