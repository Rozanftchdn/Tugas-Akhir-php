<?php 

session_start();
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

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE ['id'];
    $key = $_COOKIE['key'];
    
        //ambil username
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
         //cek cookie dan username

         if( $key == hash ('sha256', $row['username'])){
            $_SESSION['login'] = true;
         }

}

if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

    

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password

		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
               //set session
               $_SESSION["login"] = true;
               //cek rememberme
               if(isset($_POST['remember'])){
                //buat cookie
                
                setcookie('id', $row['id'], time() +60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
               }
			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    </head>
    <body>
    <?php if (isset($error)) :?>
        <p>user name salah</p>
        <?php endif;?>
    <form action="" method="POST">

    <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form>
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="text" name="username" placeholder="Username" id="username">
                    <input type="password" name="password" placeholder="Password" id="password">
                    <input type="checkbox" name="remember" placeholder="Remember Me" id="remember">
                    <button type="submit" name="login">Login</button>
                </form>
            </div>

            <div class="login">
                <form>
                    <label for="chk" aria-hidden="true">Registerasi</label>
                    <input type="text" name="username" placeholder="Username" id="username">
                    <input type="password" name="password" placeholder="Password" id="password">
                    <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" id="konfirmasi">
                    <button type="submit" name="register">Registerasi</button>

    </form>
            </div>
        </div>
    </body>

    </html>
    <!-- partial -->

</body>

</html>