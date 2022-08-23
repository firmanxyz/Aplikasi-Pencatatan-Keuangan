<?php
// Load file koneksi.php  
$conn = mysqli_connect("localhost", "root", "", "koperasi1");

// Buat query untuk menampilkan semua data siswa
if (count($_GET) !== 0) {
	$bulanGET = $_GET['bulan'];
} else {
	$bulanGET = "01";
}

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$datas = [];
	while ($data = mysqli_fetch_assoc($result)) {
		$datas[] = $data;
	}
	return $datas;
}
$datas = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataPengeluaran.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Export Data Transaksi</title>
</head>

<body>
	<h3>Data Transaksi Pengeluaran</h3>
	<table border="1">
		<tr>
			<th>ID Pengeluaran</th>
			<th>Tgl Pengeluaran</th>
			<th>Jumlah</th>
			<th>ID Sumber</th>
		</tr>
		<?php foreach ($datas as $value) : ?>
			<tr>
				<td><?= $value['id_pengeluaran']; ?></td>
				<td><?= $value['tgl_pengeluaran']; ?></td>
				<td><?= $value['jumlah']; ?></td>
				<td><?= $value['id_sumber']; ?></td>
			</tr>
		<?php endforeach  ?>
	</table>

</body>

</html>