<?php
require '../function.php';

$conn = koneksi();

// Periksa apakah ID pengguna telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data pengguna berdasarkan ID
    $query = "SELECT * FROM login WHERE iduser = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Jika data pengguna tidak ditemukan, redirect ke halaman utama admin
    if (!$user) {
        header("Location: ../indexadmin.php");
        exit;
    }
} else {
    header("Location: ../indexadmin.php");
    exit;
}

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $peran = htmlspecialchars($_POST['peran']);

    // Periksa apakah password diubah
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query_update = "UPDATE login SET username = '$username', email = '$email', peran = '$peran', password = '$password' WHERE iduser = $id";
    } else {
        $query_update = "UPDATE login SET username = '$username', email = '$email', peran = '$peran' WHERE iduser = $id";
    }
    if (mysqli_query($conn, $query_update)) {
        header("Location: ../indexadmin.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna</h6>
                                </div>
                                <div class="card-body">
                                    <form action="edituser.php?id=<?= $id ?>" method="POST">
                                        <div class="form-group">
                                            <label for="username">Nama Pengguna:</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="<?= htmlspecialchars($user['username']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="<?= htmlspecialchars($user['email']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="peran">Peran:</label>
                                            <select class="form-control" id="peran" name="peran" required>
                                                <option value="Admin" <?= $user['peran'] == 'Admin' ? 'selected' : ''; ?>>
                                                    Admin</option>
                                                <option value="User" <?= $user['peran'] == 'User' ? 'selected' : ''; ?>>
                                                    User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password (Kosongkan jika tidak ingin
                                                mengubah):</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <br>
                                        <div class="form-group text-right">
                                            <a href="../indexadmin.php" class="btn btn-danger btn-custom">Batal</a>
                                            <button type="submit" name="submit"
                                                class="btn btn-primary btn-custom">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- UI -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
</body>

</html>
