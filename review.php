<?php
include "konek.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REview produk</title>
    <style>
        .gambar {
            width: 400px;
            max-width: 100%;
            height: auto;
            border: none;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
/* --side-offset: jarak dari tiap ujung layar (menggunakan vw untuk responsive).
   Contoh:
     --side-offset: 20vw -> margin kiri+kanan 20% layar -> width center = 60%
     --side-offset: 40vw -> margin kiri+kanan 40% layar -> width center = 20%
*/
.comment-area {
  --side-offset: 20vw; /* ubah ke 40vw kalau mau 40% offset tiap sisi */
  box-sizing: border-box;
  padding: 20px 0;
}

/* container yang membatasi lebar berdasarkan offset */
.comment-container {
  width: calc(100% - (var(--side-offset) * 2));
  max-width: 980px;       /* nggak bikin terlalu lebar di layar besar */
  margin: 0 auto;         /* center */
  transition: width .2s ease;
}

/* kotak komentar individual */
.comment-box {
  background: rgba(200,200,200,0.35); /* semi gray (transparan) */
  border: 1px solid rgba(0,0,0,0.08);
  color: #222;
  padding: 18px 20px;
  border-radius: 10px;
  margin-bottom: 16px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.04);
  font-size: 18px;        /* cukup gede */
  line-height: 1.6;
}

/* header username + badge */
.comment-meta {
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:8px;
  font-weight:600;
}

/* badge role kecil */
.role-badge {
  font-size:12px;
  padding:4px 8px;
  border-radius:6px;
  color:#fff;
  background:#6c757d; /* default: user */
}
.role-badge.admin { background:#dc3545; }
.role-badge.penulis { background:#007bff; }
.role-badge.user { background:#6c757d; }

/* teks komentar */
.comment-text { 
  margin: 0;
  color: #1f1f1f;
}

/* tampilan tanggal kecil */
.comment-date {
  display:block;
  margin-top:8px;
  color:#666;
  font-size:13px;
}

/* Responsive: layar sempit -> gunakan full width minus sedikit padding */
@media (max-width: 800px) {
  .comment-container {
    width: calc(100% - 4vw);
    padding: 0 2vw;
  }
  .comment-box { font-size:16px; padding:14px; }
}

/* Kalau mau override offset per halaman: 
   di HTML: <div class="comment-area" style="--side-offset:40vw"> ... */
    </style>
  <style>
  /* Top-right edit button */
  .edit-reviews-btn{
    position: fixed;
    top: 12px;
    right: 12px;
    background:#007bff;
    color:#fff;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:600;
    z-index:9999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
  }
  .edit-reviews-btn:hover{ background:#0056b3 }
  /* Buat Review button (top-right) */
  .buat-review-btn{
    position: fixed;
    top: 12px;
    right: 92px; /* leave space so it doesn't overlap Edit button */
    background:#28a745;
    color:#fff;
    padding:8px 12px;
    border-radius:6px;
    text-decoration:none;
    font-weight:600;
    z-index:9999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
  }
  .buat-review-btn:hover{ background:#1e7e34 }
  </style>
    <!-- edit ja sini biar gampangan punyaku cuman sample -->
</head>
<body>
<?php
  include "konek.php";
  $id = isset($_GET['id_review']) ? intval($_GET['id_review']) : 0; //intinya ni kaya gini biar lalu id mulai dari 0 abis pencet link bakal berubah

        $select = "SELECT * FROM review WHERE id_review='$id'"; //ni bakalan berubah kaya diatas menyesuaikan id link
        $query = mysqli_query($koneksi, $select); // hasil query
        $data = mysqli_fetch_assoc($query); // hasil anggap ajaa koding bahasa gampangnya

        $judul = $data['judul']; // ni sama dibawah cuma manggil datanya aja jadinya jan diubah kalo gak penting
        $teks1 = $data['paragraf_buka'];
        $teks2 = $data['paragraf_jelaskan'];
        $teks3 = $data['paragraf_tutup'];
        $gambar1 = $data['gambar_1'];
        $gambar2 =  $data['gambar_2'];

        // echo "<h1>" . htmlspecialchars($judul). "</h1>";
        // echo "<p>" . htmlspecialchars($teks1). "</p>";
        // echo "<p>" . htmlspecialchars($teks2). "</p>";
        // echo "<p>" . htmlspecialchars($teks3). "</p>";
        // echo "<img src ='{$gambar1}' style='width:300px; height: auto;'>";
  ?>

  <?php
  // Split the page into two branches like front.php: logged-in vs guest
  if(isset($_SESSION['username'])){
    // cache/check permission in session
    if(isset($_SESSION['permission'])){
      $perm = strtolower(trim($_SESSION['permission']));
    } else {
      $u = mysqli_real_escape_string($koneksi, $_SESSION['username']);
      $permQ = "SELECT permission FROM login WHERE username='".$u."' LIMIT 1";
      $permR = mysqli_query($koneksi, $permQ);
      if($permR && mysqli_num_rows($permR)>0){
        $permRow = mysqli_fetch_assoc($permR);
        $perm = strtolower(trim($permRow['permission']));
        $_SESSION['permission'] = $perm;
      } else {
        $perm = '';
      }
    }

    $showCreate = in_array($perm, array('admin','penulis'));
    // lock edit to admin and penulis only (per request)
    $showEdit = in_array($perm, array('admin','penulis'));

    // if($showCreate){
    //   echo '<a class="buat-review-btn" href="in-page.php">Buat Review</a>';
    // }
    if($showEdit){
      echo '<a class="edit-reviews-btn" href="edit-review.php?id_review=' . intval($id) . '">Edit Reviews</a>';
    }
  ?>
    <center>
    <h1><?php echo $judul; ?></h1>
    <h2>RATING KAMI</h2>
    <div class="rating">
      <ul style="padding-left: 0; display:flex; gap:3px; justify-content:center; margin-bottom:20px;">
        <?php
        $rating = $data['rating'];
        for ($i = 1; $i <= 5; $i++) {
          $class = ($i <= $rating) ? "selected" : "";
          echo "<li class='$class' style='list-style:none; font-size:29px; color:" .
            ($class ? "#ffc107" : "#4d4f56ff") .
            ";'>&#9733;</li>";
        }
        ?>
      </ul>
    </div>
    <p><?php echo $teks1?></p>
    <img src="gambar/<?php echo $data['gambar_1']; ?>" style="width: 620px; height: auto;"><br><br>
    <p><?php echo $teks2?></p>
    <img src="gambar/<?php echo $gambar2 ?>" style="width: 620px; height: auto;"> 
    <p><?php echo $teks3?></p>

    <div>
    <a href="front.php">Kembali ke halaman utama</a>
    </div>

    <div class="comment-area">
    <div class="comment-container">

      <?php 
      if (isset($_SESSION['id_user'])) { 
      ?>
      <form action="proseskomen.php" method="post" style="margin-bottom: 30px;">
        <input type="hidden" name="id_review" value="<?php echo $id; ?>">
        <textarea name="komentar" placeholder="Tulis komentar..." required
        style="width:100%; height:100px; padding:10px; font-size:16px;"></textarea>
        <button type="submit" style="margin-top:10px; padding:8px 14px;">Kirim</button>
      </form>
      <?php 
      } else { 
      echo '<p>Silakan <a href="login.php">login</a> untuk menulis komentar.</p>';
      }
      ?>

      <?php
      $queryKomentar = "SELECT * FROM komentar JOIN login ON komentar.username = login.username WHERE id_review = '$id' ORDER BY id_komentar DESC";
      $hasilKomentar = mysqli_query($koneksi, $queryKomentar);

      while ($row = mysqli_fetch_assoc($hasilKomentar)) {
      ?>
      <div class="comment-box">
        <div class="comment-meta">
        <span><?php echo htmlspecialchars($row['username']); ?></span>
        <?php 
          $perm2 = strtolower($row['permission']);
          $cls = in_array($perm2, ['admin','penulis','user']) ? $perm2 : 'user';
        ?>
        <span class="role-badge <?php echo $cls; ?>">
          <?php echo strtoupper($perm2); ?>
        </span>
        </div>
        <p class="comment-text"><?php echo nl2br(htmlspecialchars($row['komentar'])); ?></p>
      </div>
      <?php
      }
      ?>

    </div>
    </div>
  </center>
  <?php
  } else {
    // guest view: no create/edit buttons
  ?>
    <center>
    <h1><?php echo $judul; ?></h1>
    <h2>RATING KAMI</h2>
    <div class="rating">
      <ul style="padding-left: 0; display:flex; gap:3px; justify-content:center; margin-bottom:20px;">
        <?php
        $rating = $data['rating'];
        for ($i = 1; $i <= 5; $i++) {
          $class = ($i <= $rating) ? "selected" : "";
          echo "<li class='$class' style='list-style:none; font-size:29px; color:" .
            ($class ? "#ffc107" : "#4d4f56ff") .
            ";'>&#9733;</li>";
        }
        ?>
      </ul>
    </div>
    <p><?php echo $teks1?></p>
    <img src="gambar/<?php echo $data['gambar_1']; ?>" style="width: 620px; height: auto;"><br><br>
    <p><?php echo $teks2?></p>
    <img src="gambar/<?php echo $gambar2 ?>" style="width: 620px; height: auto;"> 
    <p><?php echo $teks3?></p>

    <div>
    <a href="front.php">Kembali ke halaman utama</a>
    </div>

    <div class="comment-area">
    <div class="comment-container">

      <?php 
      if (isset($_SESSION['id_user'])) { 
      ?>
      <form action="proseskomen.php" method="post" style="margin-bottom: 30px;">
        <input type="hidden" name="id_review" value="<?php echo $id; ?>">
        <textarea name="komentar" placeholder="Tulis komentar..." required
        style="width:100%; height:100px; padding:10px; font-size:16px;"></textarea>
        <button type="submit" style="margin-top:10px; padding:8px 14px;">Kirim</button>
      </form>
      <?php 
      } else { 
      echo '<p>Silakan <a href="login.php">login</a> untuk menulis komentar.</p>';
      }
      ?>

      <?php
      $queryKomentar = "SELECT * FROM komentar JOIN login ON komentar.username = login.username WHERE id_review = '$id' ORDER BY id_komentar DESC";
      $hasilKomentar = mysqli_query($koneksi, $queryKomentar);

      while ($row = mysqli_fetch_assoc($hasilKomentar)) {
      ?>
      <div class="comment-box">
        <div class="comment-meta">
        <span><?php echo htmlspecialchars($row['username']); ?></span>
        <?php 
          $perm2 = strtolower($row['permission']);
          $cls = in_array($perm2, ['admin','penulis','user']) ? $perm2 : 'user';
        ?>
        <span class="role-badge <?php echo $cls; ?>">
          <?php echo strtoupper($perm2); ?>
        </span>
        </div>
        <p class="comment-text"><?php echo nl2br(htmlspecialchars($row['komentar'])); ?></p>
      </div>
      <?php
      }
      ?>

    </div>
    </div>
  </center>
  <?php
  }
  ?>

</body>
</html>