<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];

//query update
$query = mysqli_query($conn, "DELETE FROM `users` WHERE id = '$id'");

if ($query) {
    # credirect ke page index
    header("location:Data_User.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
