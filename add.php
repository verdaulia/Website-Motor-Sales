<?php

session_start();

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    
    // Upload file gambar
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO items (nama, harga, image, deskripsi) VALUES ('$nama', '$harga', '$image', '$deskripsi')";
        
        if ($conn->query($sql) === TRUE) {
            // echo "Motor baru berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengupload gambar.";
    }

    $conn->close();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Sales - Tambah Motor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Tambah Motor Baru</h1>
        <form action="add_motor.php" method="POST" enctype="multipart/form-data" class="form">
            <div class="form-group">
                <label for="name">Nama Motor</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="fileToUpload">Upload Gambar</label>
                <input type="file" name="fileToUpload" id="fileToUpload" required>
            </div>
            <button type="submit" class="button">Tambah Motor</button>
            <a href="logout.php" class="logout-button">Logout</a>
        </form>
    </div>
</body>
</html>
