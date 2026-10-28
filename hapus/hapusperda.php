<?php
require '../function.php';
$conn = koneksi();

if (isset($_GET['id'])) {
    $idperda = intval($_GET['id']);

    // Ambil nama file dari database sebelum menghapus data
    $stmt = $conn->prepare("SELECT fileperda FROM perda WHERE idperda = ?");
    $stmt->bind_param("i", $idperda);
    $stmt->execute();
    $stmt->bind_result($fileperda);
    $stmt->fetch();
    $stmt->close();

    // Path lengkap ke file
    $filePath = "../preview/previewperda/" . $fileperda;

    // Hapus file dari server jika ada
    if ($fileperda && file_exists($filePath)) {
        if (unlink($filePath)) {
            $fileDeleteStatus = "File dokumen berhasil dihapus.";
        } else {
            $fileDeleteStatus = "Gagal menghapus file dokumen.";
        }
    } else {
        $fileDeleteStatus = "File dokumen tidak ditemukan di folder.";
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM perda WHERE idperda = ?");
    $stmt->bind_param("i", $idperda);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil dihapus! (" . $fileDeleteStatus . ")');
                window.location.href = '../perda.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                window.location.href = '../perda.php';
              </script>";
    }
    $stmt->close();
}
?>