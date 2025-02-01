<?php
include('koneksi.php');  // Pastikan koneksi sudah benar

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Tidak menggunakan hash, simpan password asli

    // Query untuk menyimpan data user ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    // Menjalankan query
    if ($kon->query($sql) === TRUE) {
        $message = "Registrasii berhasil!";  // Menampilkan pesan sukses
    } else {
        $message = "Error bang, coba lagi" . $conn->error;  // Menampilkan pesan error jika gagal
    }
}

$kon->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: : 0 4px 12px rgba(0, 240, 255, 0.2);
            width: 350px;
            text-align: center;
        }
        .register-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .register-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 16px;
        }
        .register-container button {
            width: 100%;
            padding: 12px;
            background-color: #00f0ff;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .register-container button:hover {
            background-color: #00b8cc;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
        .redirect-link {
            margin-top: 15px;
            font-size: 16px;
        }
        .redirect-link a {
            color:rgb(50, 212, 224);
            text-decoration: none;
        }
        .redirect-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <!-- Menampilkan pesan jika ada -->
    <?php if ($message != ''): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

    <div class="redirect-link">
        <p>sudah punyaa akun? <a href="login_user.php">Login disinii</a></p>
    </div>
</div>

</body>
</html>
