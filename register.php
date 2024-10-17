<?php
session_start();

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            header('Location: login.php');
        } else {
            echo "Terjadi kesalahan!";
        }
    } else {
        echo "Password tidak cocok!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Motor Sales - Registrasi</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <div class="container">
      <h1 class="title">Registrasi Akun</h1>
      <form action="register.php" method="POST" class="form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required />
        </div>
        <div class="form-group">
          <label for="confirm_password">Konfirmasi Password</label>
          <input type="password" name="confirm_password" id="confirm_password" required />
        </div>
        <button type="submit" class="button">Daftar</button>
      </form>
    </div>
  </body>
</html>