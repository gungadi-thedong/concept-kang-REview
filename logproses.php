<?php
include "konek.php";
session_start();

// Ambil input dari form, pastikan tidak undefined
$user = isset($_POST['username']) ? mysqli_real_escape_string($koneksi, $_POST['username']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

// validasi input sederhana
if ($user === '' || $pass === '') {
    echo "<script>alert('Username dan password wajib diisi');window.location='login.php';</script>";
    exit;
}

// Ambil user berdasarkan username
$query = "SELECT * FROM login WHERE username = '$user' LIMIT 1";
$hasil = mysqli_query($koneksi, $query);

if ($hasil && mysqli_num_rows($hasil) > 0) {
    $comb = mysqli_fetch_assoc($hasil);

    // cek password plain-text (sesuai request: tanpa hashing)
    if ($pass === $comb['password']) {
        // login sukses -> set session
        $_SESSION['username']   = $user;
        $_SESSION['permission'] = $comb['permission'];
        $_SESSION['id_user']    = $comb['id_user'];
        echo "<script>alert('Selamat datang $user');window.location='front.php';</script>";
        exit;
    } else {
        // CHANGED: sekarang tampilkan pesan generik (jangan beri tahu bahwa password salah)
        echo "<script>alert('Username atau password salah');window.location='login.php';</script>";
        exit;
    }
} else {
    // CHANGED: username tidak ditemukan => tampilkan pesan yang SAMA seperti di atas
    echo "<script>alert('Username atau password salah');window.location='login.php';</script>";
    exit;
}
?>
