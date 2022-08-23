<?php

include "cek-sesi.php";
include "koneksi.php";

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.com/libraries/Chart.js">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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


            <!-- DataTales Example -->
            <div class="col-md-10 ps-5 pt-5" style="margin-left: 30vh;">
                <button type="button" class="btn btn-success" style="margin:10px" data-bs-toggle="modal" data-bs-target="#myModalTambah"><i class="fa fa-plus"> Tambah Users</i></button><br>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Posisi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Posisi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM users");
                                    $no = 1;
                                    $counter = 0;
                                    while ($data = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?= $data['username'] ?></td>
                                            <td><input class="form-control border-0 bg-transparent w-75 d-inline" placeholder="Masukan Data" id="input-<?= $counter ?>" type="password" name="<?= $counter + 1 ?>-1" autocomplete="off" value="<?= $data['password'] ?>">
                                                <button type="button" class="btn btn-outline-primary" id="btn-show-<?= $counter ?>" onclick="showPassword('<?= $counter ?>')">
                                                    <i class="far fa-eye-slash"></i>
                                                </button>
                                            </td>
                                            <script>
                                                function showPassword(id) {
                                                    const inputPassword = document.querySelector(`#input-${id}`);
                                                    const btnShow = document.querySelector(`#btn-show-${id}`);
                                                    if (inputPassword.type === "password") {
                                                        inputPassword.type = "text";
                                                        btnShow.style.backgroundColor = "#0d6efd";
                                                        btnShow.style.color = "#fff"
                                                    } else {
                                                        inputPassword.type = "password";
                                                        btnShow.style.backgroundColor = "transparent";
                                                        btnShow.style.color = "#0d6efd"
                                                    }
                                                }
                                            </script>
                                            <td><?= $data['level'] ?></td>
                                            <td>
                                                <!-- Button untuk modal -->
                                                <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $data['id']; ?>"></a>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Mahasiswa-->
                                        <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data User</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="proses-edit-data-user.php" method="get">

                                                            <?php
                                                            $id = $data['id'];
                                                            $query_edit = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
                                                            //$result = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>


                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Posisi</label>
                                                                    <select class="form-control" name="level" value="<?php echo $row['level']; ?>">
                                                                        <option value="admin">1. Admin</option>
                                                                        <option value="anggota">2. Anggota</option>
                                                                    </select>


                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                                    <a href="hapus-users.php?id=<?= $row['id']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>

                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <!-- Modal -->


                                    <?php
                                                                $counter++;
                                                            }
                                    ?>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <!-- Modal -->
        <div id="myModalTambah" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Users</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <!-- body modal -->
                    <form action="tambah-users.php" method="get">
                        <div class="modal-body">
                            Username :
                            <input type="text" class="form-control" name="username">
                            Password :
                            <input type="password" class="form-control" name="password">
                            Posisi :
                            <select class="form-control" name="level">
                                <option value="admin">1. Admin</option>
                                <option value="anggota">2. Anggota</option>
                            </select>
                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>

        </div>
    </div>

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