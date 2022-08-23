<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_pemasukan = $_GET['tgl_pemasukan'];
$sumber = $_GET['sumber'];
$id_sumber = $_GET['id_sumber'];
$harga_satuan = $_GET['harga_satuan'];
$jumlah_item = $_GET['jumlah_item'];
$jumlah = $harga_satuan * $jumlah_item;
//query update
$query = mysqli_query($conn, "INSERT INTO `pemasukan` (`tgl_pemasukan`, `jumlah`, `id_sumber` , `nama` , `jumlah_item` , `harga_satuan` ) VALUES ('$tgl_pemasukan', '$jumlah', '$id_sumber',  '$sumber', '$jumlah_item', '$harga_satuan')");

if ($query) {
    # credirect ke page index
    header("location:pendapatan.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
