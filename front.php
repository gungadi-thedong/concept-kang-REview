<?php
    include "konek.php"; //penting total kalo mau ambil data di db
    session_start(); // ni biar sessionnya jalan

    $query = "SELECT * from review ORDER BY id_review DESC "; //ni ngambil semua data di db tabel review dan di order descending
    $hasil = mysqli_query($koneksi, $query); // ni biar hasil query diambil dari db hasil koneksi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: auto;
    }

    .review-card {
      display: flex;
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      overflow: hidden;
      margin-bottom: 20px;
      transition: transform 0.2s ease;

    }

    .review-card:hover {
      transform: scale(1.02);
    }

    .review-card img {
      width: 200px;
      height: 130px;
      object-fit: cover;
    }

    .review-content {
      padding: 15px;
      flex: 1;
    }

    .review-content h2 {
      font-size: 20px;
      margin: 0;
      color: #333;
    }

    .review-content p {
      color: #666;
      font-size: 14px;
      margin-top: 8px;
    }

    .review-content a {
      text-decoration: none;
      color: inherit;
    }
    
    a {
        text-decoration: none;
    }
    .rating ul li {
    font-size: 18px;
    }

    .rating ul li.selected {
        color: #ffc107;
    }


  </style> 
<!-- ini diatas cuma styling doang edit sendiri nanti -->
</head>

<body>

<?php
if(isset($_SESSION['username']))
{
  ?>
            <div class="container">
            <!-- ni biar bisa di enkapsulate semuanya jadi satu edit ja ananti -->
      <h1>Review Produk Terbaru</h1> <!-- ni judul -->

      <?php
      while ($row = mysqli_fetch_assoc($hasil)) { // ni biar selalu ambil data di db reviewnya nonstop
        $id = $row['id_review']; // ni biar ada identitas review kalo di pencet nanti biar berubah primary key nya
        $judul = htmlspecialchars($row['judul']); // judul ngikut PK
        $gambar = !empty($row['gambar_1']) ? $row['gambar_1'] : 'noimage.png'; // samaa kalo gak ada malah err
        $teks = substr(strip_tags($row['paragraf_buka']), 0, 120) . '...'; // ni juga sama
        // sistem rating
      ?>

        <a href="review.php?id_review=<?php echo $id; ?>" class="review-card"> <!-- ni ni semua sampe </a> di bawah biar jadi link total dan akan berubah sesuai id review yang ada di db -->
        <img src="gambar/<?php echo $gambar; ?>" alt="<?php echo $judul; ?>"> <!-- ni judul per link  -->
        <div class="review-content"> 
          <h2><?php echo $judul; ?></h2> <!--ni sama bawah selalu ikut id revieew di db  -->
                  <div class="rating"> <!-- sistem rating -->
                      <ul style="padding-left: 0; display:flex; gap:3px;">
                          <?php
                          $rating = $row['rating']; 
                          for ($i = 1; $i <= 5; $i++) {
                              $class = ($i <= $rating) ? "selected" : "";
                              echo "<li class='$class' style='list-style:none; font-size:18px; color:" .
                                  ($class ? "#ffc107" : "#4d4f56ff") .
                                  ";'>&#9733;</li>";
                          } // intinya diatas per tiap bintang yang ada di db bakal di loop sampe 5 bintang
                          // lalu warnanya diatur apakah bintang tersebut sesuai angka rating di db atau enggak
                          // kalau bintangnya di db kurang dari 5 maka sisanya warna abu abu sedangkan sisanya kuning
                          ?>
                      </ul>
                  </div>
          <p><?php echo $teks; ?></p>
        </div>
      </a>

      <?php } ?>
    </div>
    <div>
      <center>
        <a href="logout.php" style="margin-top: 20px; display: inline-block;">Logout</a>
      </center>
    </div>
    <footer>
        <p style="text-align: center;">&copy; 2024 Review Produk. All rights reserved.</p>
    </footer>
<?php 
}
else
  { 
    ?>
    
    <div class="container">
        <!-- ni biar bisa di enkapsulate semuanya jadi satu edit ja ananti -->
  <h1>Review Produk Terbaru</h1> <!-- ni judul -->

  <?php
  while ($row = mysqli_fetch_assoc($hasil)) { // ni biar selalu ambil data di db reviewnya nonstop
    $id = $row['id_review']; // ni biar ada identitas review kalo di pencet nanti biar berubah primary key nya
    $judul = htmlspecialchars($row['judul']); // judul ngikut PK
    $gambar = !empty($row['gambar_1']) ? $row['gambar_1'] : 'noimage.png'; // samaa kalo gak ada malah err
    $teks = substr(strip_tags($row['paragraf_buka']), 0, 120) . '...'; // ni juga sama
  ?>

    <a href="review.php?id_review=<?php echo $id; ?>" class="review-card"> <!-- ni ni semua sampe </a> di bawah biar jadi link total dan akan berubah sesuai id review yang ada di db -->
    <img src="gambar/<?php echo $gambar; ?>" alt="<?php echo $judul; ?>"> <!-- ni judul per link  -->
    <div class="review-content"> 
      <h2><?php echo $judul; ?></h2> <!--ni sama bawah selalu ikut id revieew di db  -->
            <div class="rating"> <!-- sistem rating -->
                <ul style="padding-left: 0; display:flex; gap:3px;"> 
                    <?php
                    $rating = $row['rating']; 
                    for ($i = 1; $i <= 5; $i++) {
                        $class = ($i <= $rating) ? "selected" : "";
                        echo "<li class='$class' style='list-style:none; font-size:18px; color:" .
                            ($class ? "#ffc107" : "#4d4f56ff") .
                            ";'>&#9733;</li>";
                    }// intinya diatas per tiap bintang yang ada di db bakal di loop sampe 5 bintang
                    // lalu warnanya diatur apakah bintang tersebut sesuai angka rating di db atau enggak
                    // kalau bintangnya di db kurang dari 5 maka sisanya warna abu abu sedangkan sisanya kuning
                    ?>
                </ul>
            </div>
      <p><?php echo $teks; ?></p>
    </div>
  </a>

  <?php } ?>
</div>
<div>
    <center>
        <a href="login.php" style="margin-top: 20px; display: inline-block;">Login</a>
    </center>
</div>
<footer>
    <p style="text-align: center;">&copy; 2024 Review Produk. All rights reserved.</p>
</footer>
</body>
</html>
<!--  -->
<?php
  }
  ?>