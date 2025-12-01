<?php
include("config.php");

if( isset($_GET['id']) ){

    $id = (int)$_GET['id'];

    $sql = "DELETE FROM calonsiswa WHERE id=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $deleted = mysqli_stmt_execute($stmt);

    if( $deleted ){
        header('Location: list-siswa.php');
    } else {
        die("Gagal menghapus...");
    }

} else {
    die("Akses dilarang...");
}
?>