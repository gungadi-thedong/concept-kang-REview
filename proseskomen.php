<?php
session_start();
include "konek.php";

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $username = $_SESSION['username'];
    $id_review = $_POST['id_review'];
    $isi_komentar = $_POST['komentar'];

    $insert = "INSERT INTO komentar (id_review, id_user, username, komentar)
               VALUES ('$id_review', '$id_user', '$username', '$isi_komentar')";

    mysqli_query($koneksi, $insert);
    header("Location: review.php?id_review=$id_review");
} else {
    echo "<script>alert('Silakan login terlebih dahulu');window.location='login.php';</script>";
}
?>
