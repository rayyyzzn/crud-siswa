<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Jika tidak ada session atau bukan admin, redirect ke login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas CRUD - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TUGAS CRUD - Admin</span>
        <div class="ml-auto">
            <!-- Link ke halaman User -->
            <a href="user.php" class="btn btn-outline-light">User</a>
        </div>
    </nav>


    <div class="container">
        <br>
        <h4><center>DAFTAR SISWA</center></h4>

        <?php
        include "koneksi.php"; // Pastikan koneksi database ada

        // Proses delete data peserta
        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);
            $sql = "DELETE FROM peserta WHERE id_peserta = '$id_peserta'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index1.php"); // Redirect setelah berhasil
                exit();
            } else {
                echo "<div class='alert alert-danger'> Data Gagal Dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Alamat</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data peserta dari database
                $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["NISN"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
        <hr>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

</body>
</html>
