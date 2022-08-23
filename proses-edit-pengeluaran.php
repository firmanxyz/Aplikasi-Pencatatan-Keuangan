<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pengeluaran'];
$tgl = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];
$id_sumber = $_GET['id_sumber'];
$nama = $_GET['sumber'];
$harga_satuan = $_GET['harga_satuan'];
$jumlah_item = $_GET['jumlah_item'];

//query update
$query = mysqli_query($conn, "UPDATE pengeluaran SET tgl_pengeluaran='$tgl' , jumlah='$jumlah', nama='$nama', id_sumber='$id_sumber', jumlah_item='$jumlah_item', harga_satuan='$harga_satuan' WHERE id_pengeluaran='$id' ");

if ($query) {
    # credirect ke page index
    header("location:pengeluaran.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
