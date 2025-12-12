<?php
session_start();
if(!isset($_SESSION['username']))
{
    echo "<Script>alert('Silahkan login bila ingin memakai');location.href='login.php';</script>";
    //test aja ni
}
else
  {
    include "konek.php"; //penting total kalo mau ambil data di db

    $query = "SELECT * from produk"; //ni ngambil semua data di db tabel produk
    $hasil = mysqli_query($koneksi, $query); // ni biar hasil query diambil dari db hasil koneksi
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .larga-area{
            width: 700px;
            height: 230px;
            font-size: 35;
        }
    </style>
</head>
<body>
    <h1>Silahkan isi data</h1>
    <form action="insert.php" method="post" enctype="multipart/form-data"> <!-- enctype biar bisa masukin gambar dan post buat kirim data dibawah ini dan juga form action harus ke tujuaan inserting ke db-->
       <table>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> <!-- ni biar tau siapa yang upload reviewnya -->
        <tr>
            <td>nama produk</td>
            <td> : </td>
            <td>
            <select name="nama_produk" style="width: 400px; height: 30px;">
            <?php
                $query = "SELECT id_produk, nama_produk from produk"; //ni ngambil semua data di db tabel produk
                $hasil = mysqli_query($koneksi, $query); // ni biar hasil query
                while($data = mysqli_fetch_assoc($hasil)){
                    echo "<option value='".$data['id_produk']."'>".$data['nama_produk']."</option>";
                }
            ?></td>
            </select>
            
        </tr>
        <tr>
            <td>judul</td>
            <td> : </td>
            <td><textarea type="text" name="judul" class="larga-area"></textarea></td>
        </tr>
        <tr>
            <td>paragraf pembuka</td>
            <td> : </td>
            <td><textarea type="text" name="pembuka" class="larga-area"></textarea></td>
        </tr>
        <tr>
            <td>gambar produk</td> 
            <td> : </td>
            <td><input type="file" name="gambar1"></td> <!-- pastikan kaya gini kalo mau isi gambar jangan berbeda aja -->
        </tr>
        <tr>
            <td>paragraf penjelas</td>
            <td> : </td>
            <td><textarea type="text" name="penjelas" class="larga-area"></textarea></td>
        </tr>
        <tr>
            <td>paragraf penutup</td>
            <td> : </td>
            <td><textarea type="text" name="penutup" class="larga-area"></textarea></td>
        </tr>
        <tr>
            <td>gambar produk 2 </td>
            <td> : </td>
            <td><input type="file" name="gambar2"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" style="float:right" value="upload"></td>
        </tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="front.php">Kembali ke frontpage</a></td>
    </table> 
    </form>
</body>
</html>
<?php
    }
    ?>