<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pengeluaran'];

//query update
$query = mysqli_query($conn,"DELETE FROM `pengeluaran` WHERE id_pengeluaran = '$id'");

if ($query) {
 # credirect ke page index
 header("location:pengeluaran.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

//mysql_close($host);
?>