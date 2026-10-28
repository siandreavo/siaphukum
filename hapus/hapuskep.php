<?php
require '../function.php';
$conn = koneksi();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil nama file dari database sebelum menghapus data
    $stmt = $conn->prepare("SELECT filekep, filebarukep FROM keputusan WHERE idkep = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filekep, $filebarukep);
    $stmt->fetch();
    $stmt->close();

    // Hapus file lama jika ada
    if ($filekep && file_exists("../preview/previewkep/" . $filekep)) {
        unlink("../preview/previewkep/" . $filekep);
    }
    // Hapus file baru jika ada
    if ($filebarukep && file_exists("../preview/previewkep/" . $filebarukep)) {
        unlink("../preview/previewkep/" . $filebarukep);
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM keputusan WHERE idkep = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../keputusan.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
    }
    $stmt->close();
} else {
    echo "ID tidak valid.";
}

mysqli_close($conn);
?>