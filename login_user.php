<?php
session_start(); // Mulai session

$message = ''; // Variabel untuk pesan error atau sukses

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('koneksi.php'); // File koneksi database

    $username = mysqli_real_escape_string($kon, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk cek username dan password
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($kon, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username; // Simpan session username
        header("Location: tabel_user.php"); // Redirect ke tabel_user.php
        exit();
    } else {
        $message = "Username atau password salah!"; // Pesan jika login gagal
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 16px;
        }
        .login-container button {
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
        .login-container button:hover {
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

<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

    <div class="redirect-link">
        <p>belum punyaa akun?? <a href="register.php">daftar dulu yaww</a></p>
    </div>
</div>

</body>
</html>
