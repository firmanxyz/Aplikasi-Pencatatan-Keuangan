<?php

include "cek-sesi.php";
include "koneksi.php";



$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
$label1 = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "sabtu", "minggu"];


for ($bulan = 1; $bulan < 13; $bulan++) {
  $query = mysqli_query($conn, "select sum(jumlah) as jumlah from pemasukan where MONTH(tgl_pemasukan)='$bulan'");
  $row = $query->fetch_array();
  $jumlah_produk[] = $row['jumlah'];
}

$label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

for ($bulan = 1; $bulan < 13; $bulan++) {
  $query = mysqli_query($conn, "select sum(jumlah) as jumlah from pengeluaran where MONTH(tgl_pengeluaran)='$bulan'");
  $row = $query->fetch_array();
  $jumlah_produk1[] = $row['jumlah'];
}





?>
<!doctype html>
<html lang="en">
<style>

</style>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <link rel="stylesheet" type="text/css" href="fontawesome-free-6.1.1-web/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.com/libraries/Chart.js">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="icon" type="image/png" href="img/logo_smp.png" />
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
      <p></p>
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
      <?php

      $pengeluaran_hari_ini = mysqli_query($conn, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran = CURDATE()");
      $pengeluaran_hari_ini = mysqli_fetch_array($pengeluaran_hari_ini);

      $pemasukan_hari_ini = mysqli_query($conn, "SELECT jumlah FROM pemasukan where tgl_pemasukan = CURDATE()");
      $pemasukan_hari_ini = mysqli_fetch_array($pemasukan_hari_ini);


      if (is_null($pemasukan_hari_ini)) {
        $pemasukan_hari_ini['0'] = 0;
      }
      if (is_null($pengeluaran_hari_ini)) {
        $pengeluaran_hari_ini['0'] = 0;
      }

      $pemasukan = mysqli_query($conn, "SELECT * FROM pemasukan");
      while ($masuk = mysqli_fetch_array($pemasukan)) {
        $arraymasuk[] = $masuk['jumlah'];
      }
      $jumlahmasuk = array_sum($arraymasuk);


      $pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran");
      while ($keluar = mysqli_fetch_array($pengeluaran)) {
        $arraykeluar[] = $keluar['jumlah'];
      }
      $jumlahkeluar = array_sum($arraykeluar);

      $uang = $jumlahmasuk - $jumlahkeluar;

      //untuk data chart area



      $sekarang = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE()");
      $sekarang = mysqli_fetch_array($sekarang);

      $satuhari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 1 DAY");
      $satuhari = mysqli_fetch_array($satuhari);
      $duahari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 2 DAY");
      $duahari = mysqli_fetch_array($duahari);

      $tigahari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 3 DAY");
      $tigahari = mysqli_fetch_array($tigahari);

      $empathari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 4 DAY");
      $empathari = mysqli_fetch_array($empathari);

      $limahari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 5 DAY");
      $limahari = mysqli_fetch_array($limahari);

      $enamhari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 6 DAY");
      $enamhari = mysqli_fetch_array($enamhari);

      $tujuhhari = mysqli_query($conn, "SELECT jumlah FROM pemasukan
      WHERE tgl_pemasukan = CURDATE() - INTERVAL 7 DAY");
      $tujuhhari = mysqli_fetch_array($tujuhhari);

      // $datetgl = getdate(date("U"));
      // if ($sekarang['jumlah'] == null || is_null($satuhari['jumlah']) || is_null($duahari['jumlah']) || is_null($tigahari['jumlah']) || is_null($empathari['jumlah']) || is_null($limahari['jumlah']) || is_null($enamhari['jumlah']) || is_null($tujuhhari['jumlah'])) {
      //   $jmlmingguan = 0;
      // } else if ($datetgl["weekday"] == "monday") {
      //   $jmlmingguan = 0;
      // } else {
      //   $jmlmingguan = $sekarang['jumlah'] + $satuhari['jumlah'] + $duahari['jumlah'] + $tigahari['jumlah'] + $empathari['jumlah'] + $limahari['jumlah'] + $enamhari['jumlah'] + $tujuhhari['jumlah'];
      // }


      ?>

      <!-- Main Content -->
      <div class="col-md-10 ps-5 pt-5" style="margin-left: 30vh;">
        <h3 class=""><img src="icon/dashboard1.png" alt="" width="20px">&nbsp; <b>Dashboard</b></h3>
        <div class="row">
          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan (Hari Ini)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($pemasukan_hari_ini['0'], 2, ',', '.'); ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div> &nbsp Total Pendapatan : Rp.
              <?php
              echo number_format($jumlahmasuk, 2, ',', '.');
              ?>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran (Hari Ini)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($pengeluaran_hari_ini['0'], 2, ',', '.'); ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div> &nbsp Total Pengeluaran : Rp.
              <?php
              echo number_format($jumlahkeluar, 2, ',', '.');
              ?>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo Uang</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp.<?= number_format($uang, 2, ',', '.'); ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="card-body">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Chart Transaksi</h6>
              <div class="card-body">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sumber Pendapatan Dan Pengeluaran Bulanan</h6>
                    <div class="col-md-4 ps-5">
                      <div style="width: 800px;margin: 0px auto;">
                        <canvas id="myChart"></canvas>
                      </div>

                      <script>
                        var ctx = document.getElementById("myChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                            labels: <?php echo json_encode($label); ?>,
                            datasets: [{
                                label: 'Transaksi Pemasukan',
                                data: <?php echo json_encode($jumlah_produk); ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1
                              },
                              {
                                label: 'Transaksi Pengeluaran',
                                data: <?php echo json_encode($jumlah_produk1); ?>,
                                backgroundColor: 'rgb(58, 176, 255)',
                                borderColor: 'rgb(58, 176, 255)',
                                borderWidth: 1
                              }

                            ],
                          },
                          options: {
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero: true
                                }
                              }]
                            }
                          }
                        });
                      </script>

                    </div>

                  </div>
</body>

</html>