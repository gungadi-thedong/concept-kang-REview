<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('Silahkan login');location.href='login.php';</script>";
    exit;
}

include 'konek.php';

// Basic validation
$id_review = isset($_POST['id_review']) ? intval($_POST['id_review']) : 0;
if($id_review <= 0){
    echo "<script>alert('ID review tidak valid');history.back();</script>";
    exit;
}

$judul = isset($_POST['judul']) ? mysqli_real_escape_string($koneksi, $_POST['judul']) : '';
$pembuka = isset($_POST['pembuka']) ? mysqli_real_escape_string($koneksi, $_POST['pembuka']) : '';
$penjelas = isset($_POST['penjelas']) ? mysqli_real_escape_string($koneksi, $_POST['penjelas']) : '';
$penutup = isset($_POST['penutup']) ? mysqli_real_escape_string($koneksi, $_POST['penutup']) : '';
$nama_produk = isset($_POST['nama_produk']) ? intval($_POST['nama_produk']) : null;

// fetch current filenames so we can keep them if no new upload
$cur = mysqli_query($koneksi, "SELECT gambar_1, gambar_2, rating FROM review WHERE id_review='".intval($id_review)."' LIMIT 1");
$curRow = $cur ? mysqli_fetch_assoc($cur) : array('gambar_1'=>'','gambar_2'=>'','rating'=>0);

$gambar1 = $curRow['gambar_1'];
$gambar2 = $curRow['gambar_2'];
$currentRating = isset($curRow['rating']) ? intval($curRow['rating']) : 0;

// handle uploads (replace if a new file was uploaded)
if(isset($_FILES['gambar1']) && $_FILES['gambar1']['error'] == UPLOAD_ERR_OK){
    $tmp = $_FILES['gambar1']['tmp_name'];
    $name = basename($_FILES['gambar1']['name']);
    $target = 'gambar/'.time()."_".preg_replace('/[^A-Za-z0-9._-]/','_', $name);
    if(move_uploaded_file($tmp, $target)){
        // delete old file if exists
        if(!empty($gambar1) && file_exists('gambar/'. $gambar1)){
            @unlink('gambar/'. $gambar1);
        }
        // store new filename only (without path)
        $gambar1 = basename($target);
    }
}

if(isset($_FILES['gambar2']) && $_FILES['gambar2']['error'] == UPLOAD_ERR_OK){
    $tmp = $_FILES['gambar2']['tmp_name'];
    $name = basename($_FILES['gambar2']['name']);
    $target = 'gambar/'.time()."_".preg_replace('/[^A-Za-z0-9._-]/','_', $name);
    if(move_uploaded_file($tmp, $target)){
        if(!empty($gambar2) && file_exists('gambar/'. $gambar2)){
            @unlink('gambar/'. $gambar2);
        }
        $gambar2 = basename($target);
    }
}

// Build update query
$sets = array();
$sets[] = "judul='".$judul."'";
$sets[] = "paragraf_buka='".$pembuka."'";
$sets[] = "paragraf_jelaskan='".$penjelas."'";
$sets[] = "paragraf_tutup='".$penutup."'";
// rating: use posted value if valid (1-5), otherwise keep current
$postedRating = isset($_POST['rating']) ? intval($_POST['rating']) : $currentRating;
if($postedRating < 1 || $postedRating > 5) $postedRating = $currentRating;
$sets[] = "rating='".intval($postedRating)."'";
if($nama_produk) $sets[] = "id_produk='".intval($nama_produk)."'";
if($gambar1 !== null) $sets[] = "gambar_1='".mysqli_real_escape_string($koneksi, $gambar1)."'";
if($gambar2 !== null) $sets[] = "gambar_2='".mysqli_real_escape_string($koneksi, $gambar2)."'";

$sql = "UPDATE review SET " . implode(', ', $sets) . " WHERE id_review='".intval($id_review)."' LIMIT 1";

if(mysqli_query($koneksi, $sql)){
    header('Location: review.php?id_review=' . intval($id_review));
    exit;
} else {
    echo "<script>alert('Gagal menyimpan: ".mysqli_error($koneksi)."');history.back();</script>";
}

?>
