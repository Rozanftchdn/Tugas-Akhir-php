<?php 

require 'function.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('masuk pak eko');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet"  href="styleindex.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>registrasi</title>
</head>
<body>
    
    <div class="container">
      <div class="content">
        
        <form action="" method="post">
          <h1>REGISTRASI SISWA</h1>
<div class="label">
          <ul>
            <li>
              <label for="username">username :</label>
              <input type="text" name="username" id="username">
            </li>
            <li>
              <label for="password">password :</label>
              <input type="password" name="password" id="password">
            </li>
            <li>
              <label for="konfirmasi">konfirmasi password :</label>
              <input type="password" name="konfirmasi" id="konfirmasi">
            </li>
            <br><br>
            <li>
              <button type="submit" name="register">Register!</button>
            </li>
          </ul>
</div>
        </form>

          
      </div>
    </div>

    
      
</body>
</html>