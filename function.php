<?php


$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query){
    global $conn; 
$result = mysqli_query($conn, $query);
$row = [];
while( $row = mysqli_fetch_assoc ($result) ){
    $rows[] = $row;

}
 return $rows;
}

function tambah ($data) {
    global $conn;
    
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    //upload gambar
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO siswa 
                VALUES 
                ('', '$nama', '$nis', '$email', '$jurusan', '$gambar')";

     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);
    }

    function upload() {
      
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tnpName = $_FILES['gambar']['tmp_name'];
  
        // cek apakah ada gambar yg diupload
        if( $error === 4 ) {
          echo "<script>
                  alert('pilih gambar dulu');
                </script>";
            return false;
        }
  
        // cek gambar atau bukan
        $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower (end($ekstensiGambar));
  
        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
          echo "<script>
                  alert('yang anda upload bukan gambar!!!');
                </script>";
            return false;
        }
  
        // cek jika ukurannya terlalu besar
        if( $ukuranFile > 1000000 ) {
          echo "<script>
                  alert('ukuran gamabr terlau besar');
                </script>";
            return false;
        }
  
        // lolos pengecekan gambar siap di upload
        // generate nama gambar baru
  
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

  
        move_uploaded_file($tnpName, 'img/' . $namaFileBaru);
  
        return $namaFileBaru;
          
      }

    function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");

    return mysqli_affected_rows($conn);

   }
   function ubah ($data) {
    global $conn;
    


    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);
    //cek useer pilih gambar

    if($_FILES['gambar']['error'] === 4){
      $gambar = $gambarlama;
    } else {
      $gambar = upload();
    }

    $query = "UPDATE siswa SET 
                nama='$nama',
                nis='$nis',
                email='$email',
                jurusan='$jurusan',
                gambar='$gambar'
                WHERE id =$id
                ";

     mysqli_query($conn, $query);

     return mysqli_affected_rows($conn);

   }

   function cari ($kyword) {
    $query = "SELECT * FROM siswa
                WHERE
                nama LIKE '%$kyword%' OR
                nis LIKE '%$kyword%' OR
                email LIKE '%$kyword%' OR
                jurusan LIKE '%$kyword%' 

                ";
       return query($query);
   }

   function registrasi($data) {
    global $conn;
  
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($conn, $data["konfirmasi"]);
  
    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  
    if( mysqli_fetch_assoc($result) ) {
      echo "<script>
          alert('inpo username')
            </script>";
      return false;
    }
  
  
    // cek konfirmasi password
    if( $password !== $konfirmasi ) {
      echo "<script>
          alert('pasword tidak sama');
            </script>";
      return false;
    }
  
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
  
    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
  
    return mysqli_affected_rows($conn);
  
  }


?>

