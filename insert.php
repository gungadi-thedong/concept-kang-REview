<?php
    include "konek.php";

    $nama = $_POST['id_user'];
    $produk = $_POST['nama_produk'];
    $judul = $_POST['judul'];
    $parbuka = $_POST['pembuka'];
    $gambar1 = $_FILES['gambar1']['name']; // harus kay gini biar gambar berubah jadi teks dan bisa di masukin ke db
    $parjelas = $_POST['penjelas'];
    $partutup = $_POST['penutup'];
    $gambar2 = $_FILES['gambar2']['name'];

    $folder = "gambar/";

    move_uploaded_file($_FILES['gambar1']['tmp_name'], $folder . $gambar1);
    move_uploaded_file($_FILES['gambar2']['tmp_name'], $folder . $gambar2);

    $insert = "INSERT INTO review VALUES (null, '$nama', '$produk', '$judul', '$parbuka', '$gambar1', '$parjelas', '$partutup', '$gambar2')";

    $query = mysqli_query($koneksi, $insert); // biar di query hasilnya
    
    if(!$query){
       die("data error".mysqli_error($koneksi)); 
    } // ni biar error dikasi tau dimana errornya
    else{
        echo "<script>alert('Data ke enter');window.location='front.php';</script>";
    } // ni kalo data berhasil dimasukin
    
    // echo "asu";
?>