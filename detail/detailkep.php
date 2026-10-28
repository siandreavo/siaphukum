<?php
require '../function.php';
$conn = koneksi();

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mengambil data detail berdasarkan ID
$query = "SELECT * FROM keputusan WHERE idkep = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
  $diinputolehkep = htmlspecialchars($row["diinputolehkep"]);
  $judulkep = htmlspecialchars($row["judulkep"]);
  $kodenaskahkep = htmlspecialchars($row["kodenaskahkep"]);
  $nomorkep = htmlspecialchars($row["nomorkep"]);
  $opd = htmlspecialchars($row["opd"]);
  $tglpenetapankep = date('d/m/Y', strtotime($row["tglpenetapankep"]));
  $statuskep = htmlspecialchars($row["statuskep"]);
  $ketkep = htmlspecialchars($row["ketkep"]);
  $filekep = htmlspecialchars($row["filekep"]);
  $filebarukep = htmlspecialchars($row["filebarukep"]);
} else {
  echo "Data tidak ditemukan!";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Detail Keputusan</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
    type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
    rel="stylesheet" />
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-text mx-3">SIAP Hukum</div>
      </a>
      <hr class="sidebar-divider my-0" />
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">Dokumen Hukum</div>
      <li class="nav-item">
        <a class="nav-link" href="../perda.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Peraturan Daerah</span>
        </a>
        <a class="nav-link" href="../perbup.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Peraturan Bupati</span>
        </a>
        <a class="nav-link" href="../keputusan.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Keputusan</span>
        </a>
      </li>
      <hr class="sidebar-divider d-none d-md-block" />
      <div class="sidebar-heading">Surat</div>
      <li class="nav-item">
        <a class="nav-link" href="../suratmasuk.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Surat Masuk</span>
        </a>
        <a class="nav-link" href="../suratkeluar.php">
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
        <nav class="navbar navbar-expand mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
        </nav>

        <!-- Konten -->
        <div class="container-fluid">
          <h1 class="h3 mb-4 ml-4 text-gray-800">Detail Keputusan</h1>
          <div class="card shadow mb-4">
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Nomor Keputusan</th>
                    <td><?= $nomorkep; ?></td>
                  </tr>
                  <tr>
                    <th>Judul Keputusan</th>
                    <td><?= $judulkep; ?></td>
                  </tr>
                  <tr>
                    <th>Kode Naskah</th>
                    <td><?= $kodenaskahkep; ?></td>
                  </tr>
                  <tr>
                    <th>OPD</th>
                    <td><?= $opd; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Penetapan</th>
                    <td><?= $tglpenetapankep; ?></td>
                  </tr>
                  <tr>
                    <th>Dokumen</th>
                    <td><a href="../preview/previewkep/<?= $filekep; ?>" target="_blank"><?= $filekep; ?></a></td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td><?= $statuskep; ?></td>
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td><?= $ketkep; ?> <a href="../preview/previewkep/<?= $filebarukep; ?>"
                        target="_blank"><?= $filebarukep; ?></a></td>
                  </tr>
                  <tr>
                    <th>Diinput Oleh</th>
                    <td><?= $diinputolehkep; ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="../keputusan.php" class="btn btn-primary">Kembali</a>
            </div>
          </div>
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

</html>