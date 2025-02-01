<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .table-dark-blue {
            background: linear-gradient(to right, #1e3c72, #2a5298); 
            color: white;
        }

        .table-hover tbody tr {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: #66b3ff; 
            transform: scale(1.03);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #ddd;
        }

        .table th {
            padding: 12px 15px;
        }

        .table td {
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TUGAS CRUD</span>
    </nav>

<div class="container">
    <br>
    <h4><center>DAFTAR SISWA</center></h4>

<?php
    include "koneksi.php";

    if (isset($_GET['id_peserta'])) {
        $id_peserta = htmlspecialchars($_GET["id_peserta"]);

        $sql = "DELETE FROM peserta WHERE id_peserta='$id_peserta'";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            echo "<div class='alert alert-success'> Data berhasil dihapus.</div>";
        } else {
            echo "<div class='alert alert-danger'> Data gagal dihapus.</div>";
        }
    }
?>

<table class="my-3 table table-bordered table-striped table-hover">
    <thead class="table-dark-blue">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php
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
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<a href="logout.php" class="btn btn-danger mt-3">Logout</a>

</div>
</body>
</html>
