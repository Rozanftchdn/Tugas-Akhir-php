<?php
session_start();
if ( !isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}
require 'function.php';


if( isset($_POST["submit"]) ) {

    if ( tambah($_POST) > 0 ) {
        echo " 
            <script>     
                alert('data berhasil ditambah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo " 
            <script>     
                alert('data gagal ditambah');
                document.location.href = 'index.php';
            </script>
        ";
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet"  href="styleindex.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
</head>
<body>
    
    <h1>Tambah Data Siswa</h1>
    <div class="label">
    <form action="" method="post" enctype="multipart/form-data"> 
        <ul>
            <li>
                <label for="nama" id="nama">Nama :</label>
                <input type="text"  placeholder="nama" name="nama" id="nama">
            </li>
            <li>
                <label for="nis">Nis :</label>
                <input type="text" name="nis" id="nis">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li><button type="submit" name="submit">  Tambah Data  </button>
        </li>
        </ul>




</form>
</div>


</body>
</html>