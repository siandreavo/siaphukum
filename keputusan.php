<?php
require 'function.php';
$conn = koneksi();
$query = "SELECT * FROM keputusan ORDER BY nomorkep ASC"; // Mengurutkan berdasarkan nomor keputusan
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Keputusan</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
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
        <nav class="navbar navbar-expand mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
        </nav>

        <!-- Konten -->
        <div class="container-fluid">
          <h1 class="h3 mb-4 ml-4 text-gray-800">Keputusan</h1>

          <div class="container mb-5">
            <a href="tambah/tambahkep.php" class="btn btn-primary">Tambah Keputusan</a>
          </div>

          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Judul Keputusan</th>
                      <th>Kode Naskah</th>
                      <th>OPD</th>
                      <th>Status</th>
                      <th>Dokumen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?= htmlspecialchars($row["nomorkep"]); ?></td>
                        <td><?= htmlspecialchars($row["judulkep"]); ?></td>
                        <td><?= htmlspecialchars($row["kodenaskahkep"]); ?></td>
                        <td><?= htmlspecialchars($row["opd"]); ?></td>
                        <td><?= htmlspecialchars($row["statuskep"]); ?></td>
                        <td><a href="preview/previewkep/<?= htmlspecialchars($row['filekep']); ?>"
                            target="_blank"><?= htmlspecialchars($row["filekep"]); ?></a></td>
                        <td align="center">
                          <a href="detail/detailkep.php?id=<?= $row["idkep"]; ?>"
                            class="btn btn-secondary mb-1">Detail</a>
                          <a href="hapus/hapuskep.php?id=<?= $row["idkep"]; ?>" class="btn btn-danger mb-1"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                          <a href="edit/editkep.php?id=<?= $row["idkep"]; ?>" class="btn btn-warning mb-1">Edit</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- UI -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>