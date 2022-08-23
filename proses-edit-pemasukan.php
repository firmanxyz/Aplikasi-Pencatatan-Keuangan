<?php

session_start();

include('koneksi.php');

define('LOG', 'log.txt');
function write_log($log)
{
    $time = date('[Y-d-m:H:i:s]');
    $op = $time . ' ' . $log . "\n" . PHP_EOL;
    $fp = @fopen(LOG, 'a');
    $write = @fwrite($fp, $op);
    @fclose($fp);
}

$id = (int) $_GET['id_pemasukan'];
$tgl = $_GET['tgl_pemasukan'];
$jumlah = abs((int) $_GET['jumlah']);
$nama = $_GET['sumber'];
$id_sumber = $_GET['id_sumber'];
$harga_satuan = $_GET['harga_satuan'];
$jumlah_item = $_GET['jumlah_item'];


//query update
$query = mysqli_query($conn, "UPDATE pemasukan SET tgl_pemasukan='$tgl' , jumlah='$jumlah', nama='$nama', id_sumber = '$id_sumber', jumlah_item = '$jumlah_item', harga_satuan = '$harga_satuan' WHERE id_pemasukan='$id' ");
// $query1 = mysqli_query($conn, "UPDATE sumber SET nama='$sumber' WHERE id_sumber='$id_sumber' ");
$namaadmin = $_SESSION['nama'];
if ($query) {
    write_log("Nama Admin : " . $namaadmin . " => Edit Pemasukan => " . $id . " => Sukses Edit");
    # credirect ke page index
    header("location:pendapatan.php");
} else {
    write_log("Nama Admin : " . $namaadmin . " => Edit Pemasukan => " . $id . " => Gagal Edit");
    echo "ERROR, data gagal diupdate" . mysqli_error($conn);
}

//mysql_close($host);
