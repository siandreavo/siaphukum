<?php
require '../function.php';

$conn = koneksi();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM perda WHERE idperda = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $judul = strtoupper($_POST['judul']);
    $nomor = strtoupper($_POST['nomor']);
    $tanggalevaluasi = $_POST['tanggalevaluasi'];
    $tanggalpenetapan = $_POST['tanggalpenetapan'];
    $tanggalpengundangan = $_POST['tanggalpengundangan'];
    $status = strtoupper($_POST['status']);
    $nold = strtoupper($_POST['nold']);
    $noldt = strtoupper($_POST['noldt']);
    $seri = strtoupper($_POST['seri']);
    $keterangan = strtoupper($_POST['keterangan']);

    // Menangani upload file untuk fileperda
    $fileNameperda = $row['fileperda'];
    if (!empty($_FILES['fileperda']['name'])) {
        $fileTmpNameperda = $_FILES['fileperda']['tmp_name'];
        $fileNameperda = $_FILES['fileperda']['name'];
        $fileDestinationperda = '../previewperda/' . $fileNameperda;
        if (!move_uploaded_file($fileTmpNameperda, $fileDestinationperda)) {
            echo "Failed to upload fileperda.";
        }
    }

    // Menangani upload file untuk fileperda baru
    $fileNameBaru = $row['filebaruperda'];
    if (!empty($_FILES['filebaruperda']['name'])) {
        $fileTmpNameBaru = $_FILES['filebaruperda']['tmp_name'];
        $fileNameBaru = $_FILES['filebaruperda']['name'];
        $fileDestinationBaru = '../previewperda/' . $fileNameBaru;
        if (!move_uploaded_file($fileTmpNameBaru, $fileDestinationBaru)) {
            echo "Failed to upload filebaruperda.";
        }
    }

    $query = "UPDATE perda SET
        judulperda           = '$judul',
        nomorperda           = '$nomor',
        tglevaluasiperda     = '$tanggalevaluasi',
        tglpenetapanperda    = '$tanggalpenetapan',
        tglpengundanganperda = '$tanggalpengundangan',
        statusperda          = '$status',
        nold                 = '$nold',
        noldt                = '$noldt',
        seriperda            = '$seri',
        ketperda             = '$keterangan',
        fileperda            = '$fileNameperda',
        filebaruperda        = '$fileNameBaru'
        WHERE idperda        = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: ../perda.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
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
    <title>Edit Perda</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet" />

    <style>
        .form-control-file {
            border: 1px solid #ced4da;
        }
    </style>
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
                    <div class="card shadow mt-4 mb-4 text-center">
                        <h1 class="h3 mt-4 mb-4 text-gray-800">Edit Perda</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="editperda.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['idperda']); ?>">


                                <div class="form-group">
                                    <label for="judul">Judul Perda</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="<?= htmlspecialchars($row['judulperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor">Nomor Perda</label>
                                    <input type="text" class="form-control" id="nomor" name="nomor"
                                        value="<?= htmlspecialchars($row['nomorperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalevaluasi">Tanggal Evaluasi</label>
                                    <input type="date" class="form-control" id="tanggalevaluasi" name="tanggalevaluasi"
                                        value="<?= htmlspecialchars($row['tglevaluasiperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalpenetapan">Tanggal Penetapan</label>
                                    <input type="date" class="form-control" id="tanggalpenetapan"
                                        name="tanggalpenetapan"
                                        value="<?= htmlspecialchars($row['tglpenetapanperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalpengundangan">Tanggal Pengundangan</label>
                                    <input type="date" class="form-control" id="tanggalpengundangan"
                                        name="tanggalpengundangan"
                                        value="<?= htmlspecialchars($row['tglpengundanganperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="nold">No. LD</label>
                                    <input type="number" class="form-control" id="nold" name="nold"
                                        value="<?= htmlspecialchars($row['nold']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="noldt">No. LD Tambahan</label>
                                    <input type="number" class="form-control" id="noldt" name="noldt"
                                        value="<?= htmlspecialchars($row['noldt']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="seri">Seri</label>
                                    <input type="text" class="form-control" id="seri" name="seri"
                                        value="<?= htmlspecialchars($row['seriperda']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="file">Dokumen</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                    <small>Dokumen sebelumnya: <?= htmlspecialchars($row['fileperda']); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Perda</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="berlaku" <?= $row['statusperda'] == 'berlaku' ? 'selected' : ''; ?>>
                                            Berlaku</option>
                                        <option value="diubah" <?= $row['statusperda'] == 'diubah' ? 'selected' : ''; ?>>
                                            Diubah</option>
                                        <option value="dicabut" <?= $row['statusperda'] == 'dicabut' ? 'selected' : ''; ?>>
                                            Dicabut</option>
                                        <option value="diganti" <?= $row['statusperda'] == 'diganti' ? 'selected' : ''; ?>>
                                            Diganti</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        value="<?= htmlspecialchars($row['ketperda']); ?>" required>
                                </div>

                                <div id="dokumenBaru" class="form-group" style="display: none;">
                                    <label for="filebaruperda">Dokumen Baru</label>
                                    <input type="file" class="form-control-file" id="filebaruperda"
                                        name="filebaruperda">
                                    <small>Dokumen sebelumnya: <?= htmlspecialchars($row['filebaruperda']); ?></small>
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="../perda.php" class="btn btn-danger mb-1">Batal</a>
                                    <button type="submit" name="update" class="btn btn-primary">Update Perda</button>
                                </div>
                            </form>
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

    <!-- Custom Script (Buat upload dokumen baru) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var statusSelect = document.getElementById('status');
            var dokumenBaruDiv = document.getElementById('dokumenBaru');

            function toggleDokumenBaru() {
                if (statusSelect.value === 'diganti' || statusSelect.value === 'dicabut') {
                    dokumenBaruDiv.style.display = 'block';
                } else {
                    dokumenBaruDiv.style.display = 'none';
                }
            }

            toggleDokumenBaru();
            statusSelect.addEventListener('change', toggleDokumenBaru);
        });
    </script>
</body>

</html>