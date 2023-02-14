<?php
require 'function.php';

$id = $_GET["id"];

$siswa = query("SELECT * FROM siswa WHERE id = $id") [0];

if (isset ($_POST ["submit"]) ){

    if ( ubah($_POST) > 0 ) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
</head>
<body>
    <h1>Ubah Data Siswa</h1>
    <form action="" method="post" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?= $siswa["id"]?>">
        <input type="hidden" name="gambarlama" value="<?= $siswa["id"]?>">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $siswa ["nama"]?>">
            </li>
            <li>
                <label for="nis">Nis :</label>
                <input type="text" name="nis" id="nis" value="<?= $siswa ["nis"]?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?= $siswa ["email"]?>">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $siswa ["jurusan"]?>">
            </li>
            <li>
                
                <label for="gambar">Gambar :</label><br>
                <img src="img/<?=$siswa['gambar']?>" width="100"><br>
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li><button type="submit" name="submit">  Ubah Data  </button>
        </li>
        </ul>


</form>



</body>
</html>