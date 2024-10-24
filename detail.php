<?php

session_start();

include 'db.php';
$id = $_GET['id'];
$query = "SELECT * FROM items WHERE id = $id";
$result = mysqli_query($conn, $query);
$motor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Sales - Detail Motor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title"><?= $motor['nama'] ?></h1>
        <img src="images/<?= $motor['image'] ?>" alt="Gambar Motor" class="motor-image">
        <p><?= $motor['deskripsi'] ?></p>
        <p>Harga: Rp <?= $motor['harga'] ?></p>
        <a href="index.php" class="button">Kembali</a>
    </div>
</body>
</html>
