<?php
	$conn = mysqli_connect("localhost","root","","crud");


	function query($query){
		global $conn;
		$result = mysqli_query($conn,$query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function tambah($data){
		global $conn;

		$nim = htmlspecialchars($data["nim"]);
		$nama = htmlspecialchars($data["nama"]);
		$kelas = htmlspecialchars($data["kelas"]);
		$jurusan = htmlspecialchars($data["jurusan"]);
		$alamat = htmlspecialchars($data["alamat"]);
		
		//upload gambar dulu
		$gambar = upload();
		if( !$gambar){
			return false;
		}

		$query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$kelas','$jurusan','$alamat','$gambar')";
		mysqli_query($conn,$query);
		return mysqli_affected_rows($conn);
	}


	function upload() {
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		//cek apakah tidak ada gambar

		if ($error === 4){
			echo "<script>
			alert('pilih gambar terlebih dahulu!');
			</script>";

			return false;
		}

		//cek apakah yang diupload adalah gambar
		$ekstensiGambarValid =['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));

		if ( !in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
			alert('Yang anda upload bukan gambar');
			</script>";

			return false;
		}

		//cek jika ukurannya terlalu besar
		if ( $ukuranFile > 1000000){
			echo "<script>
			alert('ukuran gambar terlalu besar!');
			</script>";

			return false;
		}


		//generete nama gambar baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;

		//lolos pengecekan
		move_uploaded_file($tmpName, 'assets/img/'. $namaFileBaru);

		return $namaFileBaru;

	}

	function ubah($data){
	global $conn;
		$id = $data["id"];
		$nim = htmlspecialchars($data["nim"]);
		$nama = htmlspecialchars($data["nama"]);
		$kelas = htmlspecialchars($data["kelas"]);
		$jurusan = htmlspecialchars($data["jurusan"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$gambarlama = htmlspecialchars($data["gambarlama"]);

		//apakah user pilih gambar baru
		if ($_FILES['gambar']['error'] === 4){
			$gambar = $gambarlama;
		}else{
			$gambar = upload();
		}


	//query insert data
	$query = "UPDATE mahasiswa SET
				nim = '$nim',
				nama = '$nama',
				kelas = '$kelas',
				jurusan = '$jurusan',
				alamat = '$alamat',
				gambar = '$gambar'
			WHERE id = $id	
				
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);


}

	function hapus($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
		return mysqli_affected_rows($conn);
	}

	function cari($keyword){
		$query = "SELECT * FROM mahasiswa WHERE 
		nama LIKE '%$keyword%' OR 
		nim LIKE '%$keyword%' OR
		kelas LIKE '%$keyword%' OR
		jurusan LIKE '%$keyword%' OR
		alamat LIKE '%$keyword%'
		";
		return query($query);
	}

	function registrasi($data){
		global $conn;
		$username = strtolower(stripcslashes($data["username"]));
		$password = mysqli_real_escape_string($conn,$data["password"]);
		$password2 = mysqli_real_escape_string($conn,$data["password2"]);

		//cek konfirmasi password

		if ($password !== $password2){
			echo"
			<script>
			alert('konfirmasi password tidak sesuai')
			</script>";
			return false;
		}

		//encipsi password
		$password = password_hash($password, PASSWORD_DEFAULT);

		//cek apakah usename sudah ada
		$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
		if( mysqli_fetch_assoc($result) ){
			echo"
			<script>
			alert('username sudah terdaftar')
			</script>";
			return false;
		}

		//tambahkan user baru kedatabase
		mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");
		return mysqli_affected_rows($conn);
	}
?>