<?php
require '../function.php';
$conn = koneksi();

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Pastikan ID valid
if (isset($id) && is_numeric($id)) {
    // Hapus data dari tabel keluar
    $query = "DELETE FROM keluar WHERE idkeluar = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect ke halaman suratkeluar.php di folder utama
        header("Location: ../suratkeluar.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "ID tidak valid.";
}

mysqli_close($conn);
?>