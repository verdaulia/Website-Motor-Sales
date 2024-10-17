<?php
session_start();
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'motor_sales');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ID telah diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM items WHERE id='$id'";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // redirect kembali ke home.php
        header("Location: home.php");
    } else {
        echo "Error menghapus data: " . $conn->error;
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke halaman utama
    header("Location: home.php");
}

// Tutup koneksi
$conn->close();
?>