<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$username = $_GET['username'];
$password = $_GET['password'];
$posisi = $_GET['level'];

//query update
$query = mysqli_query($conn, "INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES ('', '$username', '$password', '$posisi')");

if ($query) {
    # credirect ke page index
    header("location:Data_User.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
