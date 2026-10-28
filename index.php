<?php 
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'function.php';
$conn = koneksi();

// Menghitung jumlah perda
$query_perda = "SELECT * FROM perda";
$result_perda = mysqli_query($conn, $query_perda);
$jumlah_perda = mysqli_num_rows($result_perda);

// Menghitung jumlah perbup
$query_perbup = "SELECT * FROM perbup";
$result_perbup = mysqli_query($conn, $query_perbup);
$jumlah_perbup = mysqli_num_rows($result_perbup);

// Menghitung jumlah keputusan
$query_kep = "SELECT * FROM keputusan";
$result_kep = mysqli_query($conn, $query_kep);
$jumlah_kep = mysqli_num_rows($result_kep);

// Menghitung jumlah pengguna
$query_pengguna = "SELECT * FROM login";
$result_pengguna = mysqli_query($conn, $query_pengguna);
$jumlah_pengguna = mysqli_num_rows($result_pengguna);

// Menampilkan daftar pengguna
$query_login = "SELECT * FROM login ORDER BY peran ASC";
$result_login = mysqli_query($conn, $query_login);

// Menghitung jumlah surat masuk
$query_masuk = "SELECT * FROM masuk";
$result_masuk = mysqli_query($conn, $query_masuk);
$jumlah_masuk = mysqli_num_rows($result_masuk);

// Menghitung jumlah surat keluar
$query_keluar = "SELECT * FROM keluar";
$result_keluar = mysqli_query($conn, $query_keluar);
$jumlah_keluar = mysqli_num_rows($result_keluar);

// Menghitung jumlah perda per tahun
$query_perda_tahun = "SELECT YEAR(tglpenetapanperda) AS tahun, COUNT(*) AS jumlah FROM perda GROUP BY YEAR(tglpenetapanperda)";
$result_perda_tahun = mysqli_query($conn, $query_perda_tahun);

// Menghitung jumlah perbup per tahun
$query_perbup_tahun = "SELECT YEAR(tglpenetapanperbup) AS tahun, COUNT(*) AS jumlah FROM perbup GROUP BY YEAR(tglpenetapanperbup)";
$result_perbup_tahun = mysqli_query($conn, $query_perbup_tahun);

// Menghitung jumlah keputusan per tahun
$query_kep_tahun = "SELECT YEAR(tglpenetapankep) AS tahun, COUNT(*) AS jumlah FROM keputusan GROUP BY YEAR(tglpenetapankep)";
$result_kep_tahun = mysqli_query($conn, $query_kep_tahun);

// Menghitung jumlah surat masuk per tahun
$query_masuk_tahun = "SELECT YEAR(tglsuratmasuk) AS tahun, COUNT(*) AS jumlah FROM masuk GROUP BY YEAR(tglsuratmasuk)";
$result_masuk_tahun = mysqli_query($conn, $query_masuk_tahun);

// Menghitung jumlah surat keluar per tahun
$query_keluar_tahun = "SELECT YEAR(tglsuratkeluar) AS tahun, COUNT(*) AS jumlah FROM keluar GROUP BY YEAR(tglsuratkeluar)";
$result_keluar_tahun = mysqli_query($conn, $query_keluar_tahun);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Side Nav -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">SIAP Hukum</div>
            </a>
            <hr class="sidebar-divider my-0" />
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <div class="sidebar-heading">Dokumen Hukum</div>
            <li class="nav-item">
                <a class="nav-link" href="perda.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Peraturan Daerah</span>
                </a>
                <a class="nav-link" href="perbup.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Peraturan Bupati</span>
                </a>
                <a class="nav-link" href="keputusan.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Keputusan</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block" />
            <div class="sidebar-heading">Surat</div>
            <li class="nav-item">
                <a class="nav-link" href="suratmasuk.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Surat Masuk</span>
                </a>
                <a class="nav-link" href="suratkeluar.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block" />
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                      <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img class="img-profile rounded-circle" src="img/user.png" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Dashboard 1 -->
                <div class="container-fluid">
                    <div class="row">
                        <!-- Perda -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peraturan Daerah</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $jumlah_perda; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Perbup -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Peraturan Bupati</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $jumlah_perbup; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Keputusan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Keputusan</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <p><?= $jumlah_kep; ?></p>
                                                    </div>
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

                        <!-- Pengguna -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Pengguna</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                              <p><?= $jumlah_pengguna; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Surat Masuk -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Surat Masuk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $jumlah_masuk; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Surat Keluar -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Surat Keluar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <p><?= $jumlah_keluar; ?></p>
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

                    <!-- Dashboard 2 -->
                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jumlah Dokumen per Tahun</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>Tahun</th>
                                            <th>Perda</th>
                                            <th>Perbup</th>
                                            <th>Keputusan</th>
                                            <th>Surat Masuk</th>
                                            <th>Surat Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Array untuk menyimpan jumlah setiap tahun
                                        $data_perda = [];
                                        while ($row = mysqli_fetch_assoc($result_perda_tahun)) {
                                            $data_perda[$row['tahun']] = $row['jumlah'];
                                        }

                                        $data_perbup = [];
                                        while ($row = mysqli_fetch_assoc($result_perbup_tahun)) {
                                            $data_perbup[$row['tahun']] = $row['jumlah'];
                                        }

                                        $data_kep = [];
                                        while ($row = mysqli_fetch_assoc($result_kep_tahun)) {
                                            $data_kep[$row['tahun']] = $row['jumlah'];
                                        }

                                        $data_masuk = [];
                                        while ($row = mysqli_fetch_assoc($result_masuk_tahun)) {
                                            $data_masuk[$row['tahun']] = $row['jumlah'];
                                        }

                                        $data_keluar = [];
                                        while ($row = mysqli_fetch_assoc($result_keluar_tahun)) {
                                            $data_keluar[$row['tahun']] = $row['jumlah'];
                                        }

                                        // Gabungkan semua tahun untuk memastikan setiap tahun terdaftar
                                        $tahun_all = array_unique(array_merge(array_keys($data_perda), array_keys($data_perbup), array_keys($data_kep), array_keys($data_masuk), array_keys($data_keluar)));

                                        foreach ($tahun_all as $tahun) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($tahun) . "</td>";
                                            echo "<td>" . htmlspecialchars(isset($data_perda[$tahun]) ? $data_perda[$tahun] : 0) . "</td>";
                                            echo "<td>" . htmlspecialchars(isset($data_perbup[$tahun]) ? $data_perbup[$tahun] : 0) . "</td>";
                                            echo "<td>" . htmlspecialchars(isset($data_kep[$tahun]) ? $data_kep[$tahun] : 0) . "</td>";
                                            echo "<td>" . htmlspecialchars(isset($data_masuk[$tahun]) ? $data_masuk[$tahun] : 0) . "</td>";
                                            echo "<td>" . htmlspecialchars(isset($data_keluar[$tahun]) ? $data_keluar[$tahun] : 0) . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- Dashboard 3 -->
                    <div class="card shadow mt-5 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Peran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_login)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['peran']) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- UI -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    </body>
    </body>
</html>
