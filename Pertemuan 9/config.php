<?php
$server = "localhost";
$user = "root";
$password = "4Drielmd.";
$nama_database = "pendaftaran_siswa";

// Menggunakan try-catch untuk menangani error koneksi lebih rapi
try {
    $db = mysqli_connect($server, $user, $password, $nama_database);
} catch (Exception $e) {
    die("Gagal terhubung dengan database: " . $e->getMessage());
}
?>