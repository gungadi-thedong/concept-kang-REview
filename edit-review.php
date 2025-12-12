<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('Silahkan login bila ingin memakai');location.href='login.php';</script>";
    exit;
}

include "konek.php"; // penting

// ambil id_review dari query string
$id_review = isset($_GET['id_review']) ? intval($_GET['id_review']) : 0;

$review = null;
if($id_review > 0){
    $sel = "SELECT * FROM review WHERE id_review='".intval($id_review)."' LIMIT 1";
    $res = mysqli_query($koneksi, $sel);
    if($res && mysqli_num_rows($res)>0){
        $review = mysqli_fetch_assoc($res);
    }
}

// load produk list for select
$produk_q = "SELECT id_produk, nama_produk FROM produk";
$produk_res = mysqli_query($koneksi, $produk_q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <style>
        .larga-area{
            width: 700px;
            height: 230px;
            font-size: 35;
        }
        .current-img{ max-width:300px; height:auto; display:block; margin-bottom:8px; }
    </style>
</head>
<body>
    <h1>Edit Review</h1>
    <?php if(!$review): ?>
        <p>Review tidak ditemukan. Pastikan Anda membuka halaman ini dari halaman review yang benar.</p>
        <p><a href="front.php">Kembali ke frontpage</a></p>
    <?php else: ?>
    <form action="update-review.php" method="post" enctype="multipart/form-data">
       <table>
        <input type="hidden" name="id_review" value="<?php echo intval($review['id_review']); ?>">
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($_SESSION['id_user']); ?>">
        <tr>
            <td>nama produk</td>
            <td> : </td>
            <td>
            <select name="nama_produk" style="width: 400px; height: 30px;">
            <?php
                if($produk_res){
                    while($p = mysqli_fetch_assoc($produk_res)){
                        $sel = (isset($review['id_produk']) && $review['id_produk'] == $p['id_produk']) ? ' selected' : '';
                        echo "<option value='".intval($p['id_produk'])."'".$sel.">".htmlspecialchars($p['nama_produk'])."</option>";
                    }
                }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td>judul</td>
            <td> : </td>
            <td><textarea name="judul" class="larga-area"><?php echo htmlspecialchars($review['judul']); ?></textarea></td>
        </tr>
        <tr>
            <td>rating</td>
            <td> : </td>
            <td>
                <select name="rating" style="width:120px; height:30px;">
                    <?php
                        $curRating = isset($review['rating']) ? intval($review['rating']) : 0;
                        for($r=1;$r<=5;$r++){
                            $s = ($curRating === $r) ? ' selected' : '';
                            echo "<option value='".$r."'".$s.">".$r." bintang</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>paragraf pembuka</td>
            <td> : </td>
            <td><textarea name="pembuka" class="larga-area"><?php echo htmlspecialchars($review['paragraf_buka']); ?></textarea></td>
        </tr>
        <tr>
            <td>gambar produk</td>
            <td> : </td>
            <td>
                <?php if(!empty($review['gambar_1'])): ?>
                    <img class="current-img" src="gambar/<?php echo htmlspecialchars($review['gambar_1']); ?>" alt="current image">
                <?php endif; ?>
                <input type="file" name="gambar1"> (biarkan kosong untuk mempertahankan gambar lama)
            </td>
        </tr>
        <tr>
            <td>paragraf penjelas</td>
            <td> : </td>
            <td><textarea name="penjelas" class="larga-area"><?php echo htmlspecialchars($review['paragraf_jelaskan']); ?></textarea></td>
        </tr>
        <tr>
            <td>paragraf penutup</td>
            <td> : </td>
            <td><textarea name="penutup" class="larga-area"><?php echo htmlspecialchars($review['paragraf_tutup']); ?></textarea></td>
        </tr>
        <tr>
            <td>gambar produk 2 </td>
            <td> : </td>
            <td>
                <?php if(!empty($review['gambar_2'])): ?>
                    <img class="current-img" src="gambar/<?php echo htmlspecialchars($review['gambar_2']); ?>" alt="current image">
                <?php endif; ?>
                <input type="file" name="gambar2"> (biarkan kosong untuk mempertahankan gambar lama)
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" style="float:right" value="Simpan perubahan"></td>
        </tr>
        <tr>
            <td colspan="3"><a href="review.php?id_review=<?php echo intval($review['id_review']); ?>">Kembali ke review</a></td>
        </tr>
    </table>
    </form>
    <?php endif; ?>
</body>
</html>
