<?php
session_start();

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        echo "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Motor Sales - Login</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <div class="container">
      <h1 class="title">Login</h1>
      <form action="login.php" method="POST" class="form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required />
        </div>
        <button type="submit" class="button">Login</button>
        <p class="text-center">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
      </form>
    </div>
  </body>
</html>
