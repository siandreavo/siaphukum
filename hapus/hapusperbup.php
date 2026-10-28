<?php
require '../function.php';
$conn = koneksi();

if (isset($_GET['id'])) {
    $idperbup = intval($_GET['id']);

    // Ambil nama file dari database sebelum menghapus data
    $stmt = $conn->prepare("SELECT fileperbup FROM perbup WHERE idperbup = ?");
    $stmt->bind_param("i", $idperbup);
    $stmt->execute();
    $stmt->bind_result($fileperbup);
    $stmt->fetch();
    $stmt->close();

    // Path lengkap ke file (Disesuaikan dengan folder preview/previewperbup/)
    $filePath = "../preview/previewperbup/" . $fileperbup;

    // Hapus file fisik dari server jika ada
    if ($fileperbup && file_exists($filePath)) {
        if (unlink($filePath)) {
            $fileDeleteStatus = "File dokumen berhasil dihapus.";
        } else {
            $fileDeleteStatus = "Gagal menghapus file dokumen.";
        }
    } else {
        $fileDeleteStatus = "File dokumen tidak ditemukan di folder.";
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM perbup WHERE idperbup = ?");
    $stmt->bind_param("i", $idperbup);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil dihapus! (" . $fileDeleteStatus . ")');
                window.location.href = '../perbup.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus dari database!');
                window.location.href = '../perbup.php';
              </script>";
    }
    $stmt->close();
}
?>