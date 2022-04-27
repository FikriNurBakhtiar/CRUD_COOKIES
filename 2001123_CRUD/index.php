<?php
require 'functions.php';

//cek session
session_start();
if ( !isset($_SESSION["login"]) ){
	header("Location: login.php");
	exit;
}
	$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

	//tombol cari diclick
	if ( isset($_POST["cari"])){
		$mahasiswa = cari($_POST["keyword"]);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tampil data</title>
</head>
<body>
	<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>
<a href="tambah.php">[+] Tambah Data</a><br><br>

<form action="" method="post">
	<input type="text" name="keyword" size="40" placeholder="Masukan keyword pencarian!" autofocus
	 autocomplete="off">
	<button type="submit" name="cari">Cari!</button>
</form><br>

<table width="100%" border="1" cellpadding="10" cellspacing="0">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nim</th>
			<th>Nama</th>
			<th>Kelas</th>
			<th>Jurusan</th>
			<th>Alamat</th>
			<th>Gambar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<?php $no= 1; ?>
	<?php foreach ($mahasiswa as $mhs) : ?>
		<tr>
			<td><?= $no ;?></td>
			<td><?= $mhs["nim"]; ?></td>
			<td><?= $mhs["nama"]; ?></td>
			<td><?= $mhs["kelas"]; ?></td>
			<td><?= $mhs["jurusan"]; ?></td>
			<td><?= $mhs["alamat"]; ?></td>
			<td><img src="assets/img/<?= $mhs["gambar"]; ?>" width="50">
				<a href="download.php?id=<?= $mhs["gambar"]; ?>">Download"</a>
			</td>
			<td>
				<a href="ubah.php?id=<?= $mhs["id"];?>">Edit</a>
				|<a href="hapus.php?id=<?= $mhs["id"];?>" onclick="return confirm('yakin ingin hapus data <?= $mhs["nama"]; ?>');">Hapus</a> 				
			</td>
		</tr>

		<?php
		$no++;
		endforeach; ?> 
</table>
	
</body>
</html>