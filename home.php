<?php
session_start();
include 'db.php'; 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query ke database untuk cek username dan password
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Jika login berhasil
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        // Jika login gagal
        echo "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Motor Sales - Halaman Utama</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <div class="hero">
      <div class="container">
        <h1 class="hero-title">Selamat Datang di Alla Luna Motors!</h1>
        <p class="hero-subtitle">The best Motor Bicycle Showroom in town.</p>
        <p class="hero-description">Temukan motor klasik dan modern terbaik untuk Anda.</p>
        <div class="action-links">
          <a href="login.php" class="button">Login</a>
          <a href="register.php" class="button secondary">Daftar</a>
        </div>
      </div>
    </div>
  </body>
</html>
