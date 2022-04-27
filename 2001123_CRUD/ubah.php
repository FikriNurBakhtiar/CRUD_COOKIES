<?php

//cek session
session_start();
if ( !isset($_SESSION["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';

//ambil data di URL
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])){

	//cek apakah data berhasil diubah atau tidak
	if ( ubah($_POST) > 0){
		echo "
		<script>alert('data berhasil diubah');
		document.location.href = 'index.php';
		</script>";
	}else{
		echo"
		<script>alert('data gagal diubah');
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
	<title>Ubah Data</title>
</head>
<body>
	<h1>Ubah Data Mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
		<tr>
			<td><input type="hidden" name="id" value="<?= $mhs["id"];?>" required="required"></td>
			<td><input type="hidden" name="gambarlama" value="<?= $mhs["gambar"];?>" required="required"></td>
		</tr>
			
		<tr>
			<td>
				Nim
			</td>
			<td>: <input type="text" name="nim" value="<?= $mhs["nim"];?>" required="required"></td>
		</tr>

		<tr>
			<td>
				Nama
			</td>
			<td>: <input type="text" name="nama" value="<?=$mhs["nama"]; ?>" required="required"></td>
		</tr>

		<tr>
			<td>
				kelas
			</td>
			<td>: <input type="text" name="kelas" value="<?=$mhs["kelas"]?>" required="required"></td>
		</tr>

		<tr>
			<td>Jurusan</td>
			<td>: <input type="text" name="jurusan" value="<?=$mhs["jurusan"];?>" required="required"></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>: <input type="text" name="alamat" value="<?=$mhs["alamat"];?>" required="required"></td>
		</tr>

		<tr>
			<td>Gambar</td>

			<td>: <img src="assets/img/<?= $mhs["gambar"];?>" width="10%" alt=""><br><br><input type="file" name="gambar"></td>
		</tr>

		<tr>
			<td><button type="submit" name="submit">Ubah</button></td>
		</tr>
		</table>
	</form>
	
</body>
</html>