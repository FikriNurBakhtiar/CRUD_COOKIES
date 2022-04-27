<?php

//cek session
session_start();
if ( !isset($_SESSION["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';
//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])){
	

	//cek apakah data berhasil ditambahkan atau tidak
	if (tambah($_POST) > 0){
		echo "
		<script>alert('data berhasil ditambahkan');
		document.location.href = 'index.php';
		</script>";
	}else{
		echo"
		<script>alert('data gagal ditambahkan');
		document.location.href = 'index.php';
		</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Data</title>
</head>
<body>
	<h1>Tambah Data Mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
		<tr>
			<td>
				Nim
			</td>
			<td>: <input type="text" name="nim" required="required"></td>
		</tr>

		<tr>
			<td>
				Nama
			</td>
			<td>: <input type="text" name="nama" required="required"></td>
		</tr>

		<tr>
			<td>
				kelas
			</td>
			<td>: <input type="text" name="kelas" required="required"></td>
		</tr>

		<tr>
			<td>Jurusan</td>
			<td>: <input type="text" name="jurusan" required="required"></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>: <input type="text" name="alamat" required="required"></td>
		</tr>

		<tr>
			<td>Gambar</td>
			<td>: <input type="file" name="gambar"></td>
		</tr>

		<tr>
			<td><button type="submit" name="submit">Simpan</button></td>
		</tr>
		</table>
	</form>
	
</body>
</html>