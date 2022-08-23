<?php

include "cek-sesi.php";
include "koneksi.php";
include "proses-cari-pengeluaran.php";

$result = query("SELECT * FROM sumber");
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

$pendapatan = query("SELECT * from pengeluaran")

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
      <div class="col-md-10 ps-5 pt-5" style="margin-left: 30vh;">
        <h3 class=""><img src="icon/pengeluaran1.png" alt="" width="20px">&nbsp; <b>Pengeluaran</b></h3>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 d-inline font-weight-bold text-primary">Sumber Pengeluaran</h6>
            <h6 class="d-inline float-end"><?= $label[(int)ltrim($bulanGET, "0") - 1] ?></h6>
          </div><br>
          <div class="px-4">
            <label for="">Pilih Bulan</label>
            <select id="bulan" class="form-select" aria-label="Default select example" onchange="toBulan(this)">
              <option selected>Silahkan Pilih Data Bulanan</option>
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
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sumber Pengeluaran</h6>
              </div>
              <div class="card-body">
                <?php
                $namasumber1 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 7 ");
                $sumbern1 = mysqli_fetch_assoc($namasumber1);

                $namasumber2 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 8 ");
                $sumbern2 = mysqli_fetch_assoc($namasumber2);

                $namasumber3 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 9 ");
                $sumbern3 = mysqli_fetch_assoc($namasumber3);

                $namasumber4 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 10 ");
                $sumbern4 = mysqli_fetch_assoc($namasumber4);

                $namasumber5 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 11 ");
                $sumbern5 = mysqli_fetch_assoc($namasumber5);

                $namasumber6 = mysqli_query($conn, "SELECT * FROM `sumber` where id_sumber= 12 ");
                $sumbern6 = mysqli_fetch_assoc($namasumber6);


                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=7");
                $jumlahhasil1 = countSumber($sumberPengeluaran);
                $sumber1 = count($sumberPengeluaran);
                $sumber1text = $sumber1;
                $sumber1 *= 10;

                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=8");
                $jumlahhasil2 = countSumber($sumberPengeluaran);
                $sumber2 = count($sumberPengeluaran);
                $sumber2text = $sumber2;
                $sumber2 *= 10;

                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=9");
                $jumlahhasil3 = countSumber($sumberPengeluaran);
                $sumber3 = count($sumberPengeluaran);
                $sumber3text = $sumber3;
                $sumber3 *= 10;

                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=10");
                $jumlahhasil4 = countSumber($sumberPengeluaran);
                $sumber4 = count($sumberPengeluaran);
                $sumber4text = $sumber4;
                $sumber4 *= 10;

                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=11");
                $jumlahhasil5 = countSumber($sumberPengeluaran);
                $sumber5 = count($sumberPengeluaran);
                $sumber5text = $sumber5;
                $sumber5 *= 10;

                $sumberPengeluaran = query("SELECT * FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%' AND id_sumber=12");
                $jumlahhasil6 = countSumber($sumberPengeluaran);
                $sumber6 = count($sumberPengeluaran);
                $sumber6text = $sumber6;
                $sumber6 *= 10;


                // $sumber1text = mysqli_num_rows($sumber1);
                // var_dump($sumber1text);
                // $sumber1 = mysqli_num_rows($sumber1);
                // $sumber1 = $sumber1 * 10;

                // $sumberPengeluaran = query("SELECT id_sumber,tgl_pengeluaran FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");
                // $sumber2 = countSumber("8", $sumberPengeluaran);
                // $sumber2text = $sumber2;
                // $sumber2 *= 10;

                // $sumberPengeluaran = query("SELECT id_sumber,tgl_pengeluaran FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");
                // $sumber3 = countSumber("9", $sumberPengeluaran);
                // $sumber3text = $sumber3;
                // $sumber3 *= 10;

                // $sumberPengeluaran = query("SELECT id_sumber,tgl_pengeluaran FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");
                // $sumber4 = countSumber("10", $sumberPengeluaran);
                // $sumber4text = $sumber4;
                // $sumber4 *= 10;

                // $sumberPengeluaran = query("SELECT id_sumber,tgl_pengeluaran FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");
                // $sumber5 = countSumber("11", $sumberPengeluaran);
                // $sumber5text = $sumber5;
                // $sumber5 *= 10;

                // $sumberPengeluaran = query("SELECT id_sumber,tgl_pengeluaran FROM pengeluaran WHERE tgl_pengeluaran LIKE '%-$bulanGET-%'");
                // $sumber6 = countSumber("12", $sumberPengeluaran);
                // $sumber6text = $sumber6;
                // $sumber6 *= 10;



                $no = 1;
                echo '
                  <h4 class="small font-weight-bold">' . $sumbern1['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil1, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width:' . $sumber1 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber1text . ' Kali</div>
                  </div>
				  <h4 class="small font-weight-bold">' . $sumbern2['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil2, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width:' . $sumber2 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber2text . ' Kali</div>
                  </div>
				  <h4 class="small font-weight-bold">' . $sumbern3['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil3, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width:' . $sumber3 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber3text . ' Kali</div>
                  </div>
				  <h4 class="small font-weight-bold">' . $sumbern4['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil4, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width:' . $sumber4 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber4text . ' Kali</div>
                  </div>
				  <h4 class="small font-weight-bold">' . $sumbern5['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil5, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width:' . $sumber5 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber5text . ' Kali</div>
                  </div>
				  <h4 class="small font-weight-bold">' . $sumbern6['nama'] . '<br><br>' . '<span class="float-right">Rp. ' . number_format($jumlahhasil6, 2, ',', '.') . '</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-dark" role="progressbar" style="width:' . $sumber6 . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber6text . ' Kali</div>
                  </div>
                  
                  
                  
                  ';
                ?>
              </div>
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="row" style="width: 150%;">
            <div class="col-xl-8 col-lg-7 ps-4">
              <button type="button" class="btn btn-success text-white mb-3" style="padding-top:12.5px" data-bs-toggle="modal" data-bs-target="#myModalTambah"><i class="fa fa-plus"> Pengeluaran</i></button>
              <button type="button" class="btn btn-warning text-white mb-3" id="" data-bs-toggle="modal" data-bs-target="#rekapDenda">
                <i class="fa-solid fa-file-invoice"></i>&nbsp; Cetak Bon
              </button><br>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Transaksi Keluar</h6>
                  <form action="" method="POST">
                    <div class="input-group mb-3" style="width: 30%; margin-left: 100vh;">
                      <input type="text" class="form-control" placeholder="Silahkan Cari" aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" autocomplete="off">
                      <button class="btn btn-primary" type="submit" id="button-addon2" name="cari">Cari</button>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Item</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah Item</th>
                          <th>Total Harga</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Item</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah Item</th>
                          <th>Total Harga</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM pengeluaran");
                        $no = 1;

                        if (isset($_POST["cari"])) {
                          $query = cari($_POST["keyword"]);
                        }

                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tgl_pengeluaran'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['harga_satuan'] ?></td>
                            <td><?= $data['jumlah_item'] ?></td>
                            <td>Rp. <?= number_format($data["jumlah"], 2, ",", "."); ?></td>
                            <td>
                              <!-- Button untuk modal -->
                              <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $data['id_pengeluaran']; ?>"></a>
                            </td>
                          </tr>
                          <!-- Modal Edit Mahasiswa-->
                          <div class="modal fade" id="myModal<?php echo $data['id_pengeluaran']; ?>" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Ubah Data Pengeluaran</h4>
                                  <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <form role="form" action="proses-edit-pengeluaran.php" method="get">

                                    <?php
                                    $id = $data['id_pengeluaran'];
                                    $query_edit = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id_pengeluaran='$id'");
                                    //$result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($query_edit)) {
                                    ?>


                                      <input type="hidden" name="id_pengeluaran" value="<?php echo $row['id_pengeluaran']; ?>">


                                      <div class="form-group">
                                        <input type="hidden" name="id_sumber" id="input_sumber" value="<?php echo $row['id_sumber']; ?>">
                                      </div>

                                      <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tgl_pengeluaran" class="form-control" value="<?php echo $row['tgl_pengeluaran']; ?>">
                                      </div>

                                      <div class="form-group">
                                        <label>Item</label>

                                        <select class="form-control" name="sumber" id="select_sumber">
                                          <?php foreach ($result as $data1) : ?>
                                            <option value="<?= $data1['nama'] ?>"><?= $data1['nama'] ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                      <?php foreach ($result as $data1) : ?>
                                        <p id="<?= str_replace(" ", "", $data1['nama']) ?>" hidden><?= $data1['id_sumber'] ?></p>
                                      <?php endforeach ?>
                                      <div class="form-group">
                                        <label>Harga Satuan</label>
                                        <input type="text" name="harga_satuan" class="form-control" value="<?php echo $row['harga_satuan']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label>Jumlah Item</label>
                                        <input type="text" name="jumlah_item" class="form-control" value="<?php echo $row['jumlah_item']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="text" name="jumlah" class="form-control" value="<?php echo $row['jumlah']; ?>">
                                      </div>
                                </div>

                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Ubah</button>
                                  <a href="hapus-pengeluaran.php?id_pengeluaran=<?= $row['id_pengeluaran']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                  <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                                </div>
                              <?php
                                    }
                                    //mysql_close($host);
                              ?>
                              </form>
                              </div>
                            </div>

                          </div>
                  </div>
                  <!-- Modal rekap denda -->
                  <div class="modal fade" id="rekapDenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rekapDendaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="rekapDendaLabel">Cetak Bon</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="cetakbon1.php" method="POST">
                            <div class="mb-3">
                              <label for="cetak" class="form-label">Data Yang Dicetak</label>
                              <input type="text" class="form-control" id="cetak" name="cetak">
                              <label for="tgl_pengeluaran" class="form-label">Tanggal Pembelian</label>
                              <input class="form-control" autocomplete="off" list="datalistOptions3" id="dataList" name="tgl_pengeluaran" placeholder="Masukkan Tanggal Pembelian" required>
                              <datalist id="datalistOptions3">
                                <?php foreach ($pendapatan as $key => $value) : ?>
                                  <?php
                                  $tgl_pendapatan = $value['tgl_pengeluaran'];
                                  $sumber = $value['nama'];
                                  // $id = query("SELECT id_pengeluaran from pengeluaran where tgl_pengeluaran='$tgl_pendapatan'");
                                  var_dump($key);
                                  ?>
                                  <option value="<?= $tgl_pendapatan ?>_<?= $sumber ?>"><?= $value['tgl_pengeluaran'], " ", $value['nama'] ?></option>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Kirim</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end modal rekap denda -->
                  <!-- Modal -->
                  <div id="myModalTambah" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- konten modal-->
                      <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Pengeluaran</h4>
                          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <!-- body modal -->
                        <form action="tambah-pengeluaran.php" method="get">
                          <div class="modal-body">
                            ID Sumber :
                            <input type="text" class="form-control" name="id_sumber" id="input_sumber" readonly>
                            Tanggal :
                            <input type="date" class="form-control" name="tgl_pengeluaran" value="<?php echo date("Y-m-d"); ?>">
                            <div class="form-group">
                              <label>Item :</label>
                              <select class="form-control" name="sumber" id="select_sumber">
                                <?php foreach ($result as $data1) : ?>
                                  <option value="<?= $data1['nama'] ?>"><?= $data1['nama'] ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <?php foreach ($result as $data1) : ?>
                              <p id="<?= str_replace(" ", "", $data1['nama']) ?>" hidden><?= $data1['id_sumber'] ?></p>
                            <?php endforeach ?>
                            Harga Satuan :
                            <input type=" text" class="form-control" name="harga_satuan">
                            Jumlah Item :
                            <input type=" text" class="form-control" name="jumlah_item">

                            <!-- footer modal -->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Tambah</button>
                        </form>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                      </div>
                    </div>

                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <script>
        const selectEl = document.querySelectorAll("#select_sumber");
        selectEl.forEach((el, i) => {
          el.onchange = (e) => {
            console.log(i);
            console.log(document.querySelectorAll("#input_sumber"));
            const sumber = e.target.value.replace(/\s/g, "")
            const tagElement = document.querySelector("#" + sumber);
            if (tagElement === null) {
              document.querySelectorAll("#input_sumber")[i].value = ""
            } else {
              document.querySelectorAll("#input_sumber")[i].value = tagElement.innerText
            }
          }
        })
      </script>
      <script>
        const bulan = document.querySelector("#bulan")
        console.log(bulan);
        bulan.selectedIndex = "<?= (int)$bulan ?>"
      </script>
      <script>
        function toBulan(e) {
          console.log(e);
          window.location.href = `Pengeluaran.php?bulan=${e.value}`
        }
      </script>

      <script>
        const dataList = document.querySelector("#dataList");
        dataList.onchange = (e) => {
          console.log(e);

          const idCetak = document.querySelector("#cetak");
          idCetak.value += dataList.value + ",";

        }
      </script>
</body>
</tbody>
</table>
</div>
</div>
</div>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</html>