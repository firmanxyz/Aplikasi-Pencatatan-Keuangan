<?php
include "koneksi.php";

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM pengeluaran
                WHERE
                tgl_pengeluaran LIKE '%$keyword%'OR
                jumlah LIKE '%$keyword%'OR
                nama LIKE '%$keyword%'
                ";
    $result = mysqli_query($conn, $query);
    return $result;
}
