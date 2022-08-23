<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_pengeluaran = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];
$sumber = $_GET['sumber'];
$id_sumber = $_GET['id_sumber'];
$harga_satuan = $_GET['harga_satuan'];
$jumlah_item = $_GET['jumlah_item'];
$jumlah = $harga_satuan * $jumlah_item;

//query update
$query = mysqli_query($conn, "INSERT INTO `pengeluaran` (`tgl_pengeluaran`, `jumlah`, `nama`, `id_sumber`, `jumlah_item`, `harga_satuan`) VALUES ('$tgl_pengeluaran', '$jumlah', '$sumber', '$id_sumber', '$jumlah_item', '$harga_satuan')");

if ($query) {
    # credirect ke page index
    header("location:pengeluaran.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
