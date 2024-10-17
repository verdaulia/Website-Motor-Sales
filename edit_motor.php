<?php
session_start();

require 'db.php';

$id = $_GET['id'];

// Ambil data motor berdasarkan ID
$sql = "SELECT * FROM items WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $image = $_FILES['image']['name'];

    // Jika gambar di-upload, proses upload gambar baru
    if (!empty($image)) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Update dengan gambar baru
        $sql = "UPDATE items SET nama='$nama', harga='$harga', image='$image', deskripsi='$deskripsi' WHERE id=$id";
    } else {
        // Update tanpa mengubah gambar
        $sql = "UPDATE items SET nama='$nama', harga='$harga', deskripsi='$deskripsi' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Motor</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Motor</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Motor:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>

            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>

            <label for="image">Upload Gambar (kosongkan jika tidak ingin mengubah):</label>
            <input type="file" id="image" name="image">
            <br>
            <img src="images/<?php echo $row['image']; ?>" width="100" alt="Gambar Motor">
            <br><br>

            <input type="submit" value="Update Motor">
        </form>
        <a href="home.php">Kembali</a>
    </div>
</body>
</html>