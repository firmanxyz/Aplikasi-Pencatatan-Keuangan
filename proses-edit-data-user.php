<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$username = $_GET['username'];
$password = $_GET['password'];
$level = $_GET['level'];

//query update
$query = mysqli_query($conn, "UPDATE users SET id='$id' , username='$username', password='$password', level='$level' WHERE id='$id' ");

if ($query) {
    # credirect ke page index
    header("location:Data_User.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
