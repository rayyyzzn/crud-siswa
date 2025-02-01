<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include "koneksi.php"; // Koneksi ke database

// Pastikan koneksi berhasil
if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi Approve User
if (isset($_GET['approve'])) {
    $id_user = intval($_GET['approve']);
    $sql_approve = "UPDATE users SET status='approved' WHERE id_user=$id_user";
    mysqli_query($kon, $sql_approve);
    header("Location: user.php");
    exit();
}

// Fungsi Delete User
if (isset($_GET['delete'])) {
    $id_user = intval($_GET['delete']);
    $sql_delete = "DELETE FROM users WHERE id_user=$id_user";
    mysqli_query($kon, $sql_delete);
    header("Location: user.php");
    exit();
}

// Fungsi Tambah User
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($kon, $_POST['username']);
    $password = mysqli_real_escape_string($kon, $_POST['password']);
    $status = 'pending'; // Default status untuk user baru

    $sql_insert = "INSERT INTO users (username, password, status) VALUES ('$username', '$password', '$status')";
    if (mysqli_query($kon, $sql_insert)) {
        header("Location: user.php");
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan user: " . mysqli_error($kon) . "');</script>";
    }
}

// Ambil data user
$sql = "SELECT id_user, username, password, status FROM users";
$result = mysqli_query($kon, $sql);
if (!$result) {
    die("Query gagal: " . mysqli_error($kon));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TUGAS CRUD - Admin</span>
        <div class="ml-auto">
            <a href="index1.php" class="btn btn-outline-light">Dashboard</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="text-center">DAFTAR USER</h4>

        <!-- Tabel Data User -->
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['id_user']); ?></td>
                        <td><?php echo htmlspecialchars($data['username']); ?></td>
                        <td><?php echo htmlspecialchars($data['password']); ?></td>
                        <td><?php echo htmlspecialchars($data['status']); ?></td>
                        <td>
                            <?php if ($data['status'] === 'pending') { ?>
                                <a href="user.php?approve=<?php echo $data['id_user']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <?php } ?>
                            <a href="user.php?delete=<?php echo $data['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</a>
                        </td>
                    </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>

        <!-- Form Tambah User -->
        <h5 class="mt-4">Tambah User Baru</h5>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="add_user" class="btn btn-primary">Tambah User</button>
        </form>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
    
</body>
</html>
