<?php
include("config.php");

if(isset($_POST['simpan'])){

    $id = (int)$_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];

    $sql = "UPDATE calonsiswa SET nama=?, alamat=?, jenis_kelamin=?, agama=?, sekolah_asal=? WHERE id=?";
    
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $alamat, $jk, $agama, $sekolah, $id);
    
    $updated = mysqli_stmt_execute($stmt);

    if( $updated ) {
        header('Location: list-siswa.php');
    } else {
        die("Gagal menyimpan perubahan...");
    }

} else {
    die("Akses dilarang...");
}
?>