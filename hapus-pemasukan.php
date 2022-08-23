<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pemasukan'];

//query update
$query = mysqli_query($conn,"DELETE FROM `pemasukan` WHERE id_pemasukan = '$id'");

if ($query) {
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

//mysql_close($host);
