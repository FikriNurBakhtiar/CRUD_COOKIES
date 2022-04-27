<?php
session_start();
require 'functions.php';

//cek cookie

if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasrakan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row =  mysqli_fetch_assoc($result);

	//cek cookei dan username
	if ( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}
}

 if ( isset($_SESSION["login"])){
 	header("Location: index.php");
 	exit;
 }

	if( isset($_POST["login"]) ){
		$username = $_POST["username"];
		$password = $_POST["password"];

		$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

		//cek username
		if( mysqli_num_rows($result) === 1){

			//cek password
			$row = mysqli_fetch_assoc($result);
			if( password_verify($password, $row["password"])){
				// set sessions
				$_SESSION["login"] = true;

				//cek remeber me
				if ( isset($_POST["remember"]) ){

					//buat cookie
					setcookie('id', $row['id'], time()+600);
					setcookie('key', hash('sha256', $row['username']), time()+600);
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1>Halaman Login</h1>

	<?php  if( isset($error) ): ?>
		<p style="color: red; font-style: italic;">username atau password salah</p>

	<?php endif; ?>
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>: <input type="text" name="username" required="required"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>: <input type="password" name="password" required="required"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="remember"></td>
				<td>Remember me</td>
			</tr>

			<tr>
				<td><button type="submit" name="login">Login</button></td>
			</tr>
		</table>
	</form>
</body>
</html>