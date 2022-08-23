<?php
include "cek-sesi.php";
include "koneksi.php";

include "proses-cari-pendapatan.php";


// $label = ["2020", "2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030"];
$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
if (count($_GET) !== 0) {
  $bulanGET = $_GET['bulan'];
} else {
  $bulanGET = "01";
}

function countSumber($sumberPengeluaran)
{
  $countId = 0;

  foreach ($sumberPengeluaran as $key => $value) {
    $jumlah[] = $value['jumlah'];
  }

  if (isset($jumlah)) return array_sum($jumlah);
  else return 0;
}
?>

<!doctype html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-6.1.1-web/css/all.min.css">
  <link rel="icon" href="/img/logo_smp.png" type="image/png" sizes="16x16">
  <title>Dashboard</title>
</head>

<body>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

  <!-- Navigasi Bar -->
  <script type="text/javascript" src="dashboard.js"></script>
  <nav class="navbar navbar-light bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">
        <img src="img/logo_smp.png" alt="" width="50" height="50" class="d-inline-block align-text-center">
        <b>KOPERASI SMPN 52 BEKASI</b>
      </a>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="row no-gutters">
      <div class="col-md-2 bg-secondary mt-2 pr-3 pt-4 sidebar position-fixed">
        <ul class="nav flex-column mb-5">
          <li class="logo-user">
            <img src="img/user.png" alt="" width="100"><br>Halo, <?= $_SESSION['username']; ?>
            <hr>
          </li>
          <?php

          if ($_SESSION['level'] == 'user' || $_SESSION['level'] == 'admin') {

          ?>
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="Dashboard.php"><img src="icon/dashboard.png" alt="" width="20px">&nbsp; Dashboard</a>
              <hr>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="Pendapatan.php"><img src="icon/pemasukan.png" alt="" width="20px">&nbsp;Pendapatan</a>
              <hr>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="Pengeluaran.php"><img src="icon/pengeluaran.png" alt="" width="20px">&nbsp;Pengeluaran</a>
              <hr>
            </li>


          <?php }  ?>
          <?php
          if ($_SESSION['level'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="Data_User.php"><img src="icon/group.png" alt="" width="20px">&nbsp;Data User</a>
              <hr>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="Laporan.php"><img src="icon/report.png" alt="" width="20px">&nbsp;Laporan</a>
            <hr>
          </li>
          <!-- Button trigger modal -->
          <a href="keluar.php" onclick="return confirm('ingin keluar?')"><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#logout">
              <img src="icon/logout.png" alt="" width="20px">&nbsp;Logout
            </button>
          </a>
          <hr>
          </li>
        </ul>
      </div>
      <div class="col-md-10 ps-5 pt-5" style="margin-left: 32vh; margin-top: 3vh;">
        <h3 class=""><img src="icon/report1.png" alt="" width="20px">&nbsp; <b>Laporan</b></h3>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 d-inline font-weight-bold text-primary">Laporan Total Transaksi</h6>
              <h6 class="d-inline float-end"><?= $label[(int)ltrim($bulanGET, "0") - 1] ?></h6>
            </div>
            <div class="px-4">
              <label for="">Pilih Bulan</label>
              <select id="bulan" class="form-select" aria-label="Default select example" onchange="toBulan(this)">
                <option selected>Silahkan Pilih Data Bulan</option>
                <?php foreach ($label as $index => $bulan) : ?>
                  <?php if (strlen($index) == 1) : ?>
                    <option value="0<?= $index + 1 ?>"><?= $bulan ?></option>
                  <?php else : ?>
                    <option value="<?= $index + 1 ?>"><?= $bulan ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Transaksi</th>
                      <th>Jumlah Transaksi </th>
                      <th>Jumlah Total Uang</th>
                      <th>Download</th>
                    </tr>
                  </thead>
                  <tfoot>
                  </tfoot>
                  <tbody>
                    <?php
                    // $pemasukan = mysqli_query($conn, "SELECT * FROM pemasukan");
                    // while ($masuk = mysqli_fetch_array($pemasukan)) {
                    //   $arraymasuk[] = $masuk['jumlah'];
                    // }
                    // $jumlahmasuk = array_sum($arraymasuk);

                    $sumberpemasukan = query("SELECT * FROM pemasukan WHERE tgl_pemasukan LIKE '%-$bulanGET-%' AND id_pemasukan");
                    $jumlahhasil1 = countSumber($sumberpemasukan);
                    $sumber1 = count($sumberpemasukan);
                    $sumber1text = $sumber1;

                    $sumberpengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_pengeluaran");
                    $jumlahhasil2 = countSumber($sumberpengeluaran);
                    $sumber2 = count($sumberpengeluaran);
                    $sumber2text = $sumber2;


                    // $pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran");
                    // while ($keluar = mysqli_fetch_array($pengeluaran)) {
                    //   $arraykeluar[] = $keluar['jumlah'];
                    // }
                    // $jumlahkeluar = array_sum($arraykeluar);


                    // $query1 = mysqli_query($conn, "SELECT id_pemasukan FROM pemasukan");
                    // $query1 = mysqli_num_rows($query1);

                    // $query2 = mysqli_query($conn, "SELECT id_pengeluaran FROM pengeluaran");
                    // $query2 = mysqli_num_rows($query2);
                    $no = 1;
                    ?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?= $sumber1text ?></td>
                      <td>Rp. <?= number_format($jumlahhasil1, 2, ',', '.'); ?></td>
                      <td>
                        <!-- Button untuk modal -->
                        <a href="export-pemasukan.php?bulan=<?= $bulanGET ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
                      </td>
                    </tr>

                    <tr>
                      <td>Pengeluaran</td>
                      <td><?= $sumber2text ?></td>
                      <td>Rp. <?= number_format($jumlahhasil2, 2, ',', '.'); ?></td>
                      <td>
                        <!-- Button untuk modal -->
                        <a href="export-pengeluaran.php?bulan=<?= $bulanGET ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
                      </td>
                    </tr>
                    <script>
                      const bulan = document.querySelector("#bulan")
                      console.log(bulan);
                      bulan.selectedIndex = "<?= (int)$bulan ?>"
                    </script>
                    <script>
                      function toBulan(e) {
                        console.log(e);
                        window.location.href = `Laporan.php?bulan=${e.value}`
                      }
                    </script>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
</body>


</html>