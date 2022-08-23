<?php

include 'koneksi.php';

function query($query)
{

    global $conn;

    $result = mysqli_query($conn, $query);
    $datas  = [];

    while ($data = mysqli_fetch_assoc($result)) {

        $datas[] = $data;
    }
    return $datas;
}

$tgl_cetak          = explode(',', $_POST['cetak']);
$pendapatan;
foreach ($tgl_cetak as $tgl) {
    if (strlen($tgl) == 0) continue;
    $tgl_pemasukan = explode('_', $tgl)[0];
    $sumber = explode('_', $tgl)[1];
    $pendapatan[] = query("SELECT * from pemasukan where tgl_pemasukan='$tgl_pemasukan' and nama='$sumber'");
}
// var_dump($pendapatan);

$jumlah = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- manggil css -->
    <link rel="stylesheet" type="text/css" href="css/Dashboard.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="icon" type="image/png" href="./img/logo_smp_preview_rev_1.png" />

    <!-- script manggil si font-awesome -->
    <script src="https://kit.fontawesome.com/5abd65a6aa.js" crossorigin="anonymous"></script>

    <title>Laporan</title>
</head>

<body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/Dashboard.js"></script>

    <h4 class="mt-5" style="text-align: center;">KOPERASI SMPN 52 BEKASI</h4>
    <h6 style="text-align: center;">RT.004/RW.007, Kranji, Kec. Bekasi Barat, Kota Bks, Jawa Barat 17135</h6>
    <h4 style="text-align: center;">BON PENDAPATAN</h4>

    <table class="table table-borderless mx-5 mt-5">

        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Item</th>
                <th>Harga Satuan</th>
                <th>Jumlah Item</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendapatan as $key => $value) : ?>
                <tr>
                    <td><?= $value[0]['tgl_pemasukan'] ?></td>
                    <td><?= $value[0]['nama'] ?></td>
                    <td><?= $value[0]['harga_satuan'] ?></td>
                    <td><?= $value[0]['jumlah_item'] ?></td>
                    <td><?= $value[0]['jumlah'] ?></td>
                    <?php $jumlah += $value[0]['jumlah'] ?>
                </tr>

            <?php endforeach ?>
            <tr>
                <td colspan="4">Total Harga</td>
                <td> <?= $jumlah; ?> </td>
            </tr>
        </tbody>
    </table>
    <h6 class="mt-5" style="text-align: center;">TERIMAKASIH SUDAH BERBELANJA DI KOPERASI SMPN 52 KOTA BEKASI</h6>
    <script>
        window.print()
    </script>
</body>

</html>