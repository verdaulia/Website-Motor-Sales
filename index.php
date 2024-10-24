<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Jika sesi belum ada, redirect ke halaman untuk login/daftar
    header("Location: home.php");
    exit;
}

// Koneksi ke database
$host = 'localhost';
$db = 'motor_sales';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi Gagal: ' . $conn->connect_error);
}

// Tambah motor baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Proses upload gambar
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Masukkan data ke database
    $sql = "INSERT INTO items (nama, harga, image, deskripsi) VALUES ('$nama', '$harga', '$image', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        // echo "Motor baru berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data motor dari database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alla Luna Motors</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Alla Luna Motors</h1>
            <p>Daftar motor klasik dan modern terbaik kami</p>
        </header>

        <section class="motor-list">
            <h2>Daftar Motor</h2>
            <table class="motor-table">
                <thead>
                    <tr>
                        <th>Nama Motor</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['nama']; ?></td>
                                <td><img src="images/<?php echo $row['image']; ?>" alt="Gambar Motor"></td>
                                <td><?php echo $row['deskripsi']; ?></td>
                                <td><a href="delete_motor.php?id=<?php echo $row['id']; ?>">Hapus</a>
                                <a href="detail.php?id=<?php echo $row['id']; ?>">Detail</a>
                                <a href="edit_motor.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr><td colspan="4">Belum ada motor yang ditambahkan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <section class="add-motor">
            <h2>Tambah Motor Baru</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nama">Nama Motor:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>

                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" required>

                <label for="image">Upload Gambar:</label>
                <input type="file" id="image" name="image" required>
                
                <input type="submit" value="Tambah Motor">
            </form>
        </section>
        <br>
        <a href="logout.php" class="logout-button">Logout</a>
                    </br>
        <footer>
            <p>&copy; 2024 Alla Luna Motors. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
