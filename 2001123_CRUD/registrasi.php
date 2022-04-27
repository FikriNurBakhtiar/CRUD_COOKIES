<?php
require 'functions.php';

//jika tombol register ditekan

if( isset($_POST["registrasi"])){
	if( registrasi($_POST)> 0 ){
		echo"
		<script>
		alert('user baru berhasil ditambahkan');
		</script>";
	} else{
		echo mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrasi</title>
</head>
<body>

	<h1>Halaman Registrasi</h1>

	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>: <input type="text" name="username"></td>
			</tr>

			<tr>
				<td>Password</td>
				<td>: <input type="password" name="password"></td>
			</tr>

			<tr>
				<td>Repeat Password</td>
				<td>: <input type="password" name="password2"></td>
			</tr>

			<tr>
				<td><button type="submit" name="registrasi">Registrasi</button></td>
			</tr>
		</table>
	</form>
	
</body>
</html>