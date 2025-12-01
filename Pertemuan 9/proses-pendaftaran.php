<?php
include("config.php");

// Cek apakah tombol daftar sudah diklik
if(isset($_POST['daftar'])){

    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];

    // Buat query dengan Prepared Statement (Tanda tanya ? adalah placeholder)
    $sql = "INSERT INTO calonsiswa (nama, alamat, jenis_kelamin, agama, sekolah_asal) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($db, $sql);

    // Bind parameter (s = string) -> ada 5 string
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $alamat, $jk, $agama, $sekolah);

    // Eksekusi query
    $saved = mysqli_stmt_execute($stmt);

    if($saved) {
        header('Location: index.php?status=sukses');
    } else {
        header('Location: index.php?status=gagal');
    }

    mysqli_stmt_close($stmt);

} else {
    die("Akses dilarang...");
}
?>