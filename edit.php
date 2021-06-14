<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>DATA SMA DI PROVINSI SUMATERA UTARA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">SMA INFORMATION SYSTEM	|</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Edit Sekolah</h2>
		
		<hr>
		
		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['npsn'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$npsn = $_GET['npsn'];
			
			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM sekolah WHERE npsn='$npsn'") or die(mysqli_error($koneksi));
			
			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>
		
		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$npsn			= $_POST['npsn'];
			$nama			= $_POST['nama'];
			$kode			= $_POST['kodeKelas'];
			$kelas			= $_POST['kelas'];
			$totalLaki		= $_POST['totalLaki'];
		$totalPerempuan		= $_POST['totalPerempuan'];
			$total			= $_POST['total'];
			
			$sql = mysqli_query($koneksi, "UPDATE sekolah SET nama='$nama', kode='$kode', kelas='$kelas', totalLaki='$totalLaki', totalPerempuan='$totalPerempuan', total='$total' WHERE npsn='$npsn'") or die(mysqli_error($koneksi));
			
			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="edit.php?npsn='.$npsn.'";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>
		
		<form action="edit.php?npsn=<?php echo $npsn; ?>" method="post">
		<div class="form-group row">
				<label class="col-sm-2 col-form-label">NPSN</label>
				<div class="col-sm-10">
					<input type="text" name="npsn" value="<?= $npsn; ?>" class="form-control" size="4" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA SEKOLAH</label>
				<div class="col-sm-10">
					<input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">KODE KELAS</label>
				<div class="col-sm-10">
					<input type="text" name="kodeKelas" value="<?= $data['kode']; ?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">KELAS</label>
				<div class="col-sm-10">
					<input type="text" name="kelas" value="<?= $data['kelas']; ?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TOTAL SISWA LAKI LAKI</label>
				<div class="col-sm-10">
					<input type="number" name="totalLaki" id="totalLaki" value="<?= $data['totalLaki']; ?>" class="form-control" onkeyup="hitung()" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TOTAL SISWA PEREMPUAN</label>
				<div class="col-sm-10">
					<input type="number" name="totalPerempuan" id="totalPerempuan" value="<?= $data['totalPerempuan']; ?>" class="form-control" onkeyup="hitung()" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TOTAL SISWA</label>
				<div class="col-sm-10">
					<input type="number" name="total" id="hasil" value="<?= $data['total']; ?>" class="form-control" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="index.php" class="btn btn-warning" value="KEMBALI">KEMBALI</a>
				</div>
			</div>
		</form>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script>
		function hitung() {
			var totalLaki = $("#totalLaki").val();
			var totalPerempuan = $("#totalPerempuan").val();
			var hasil = parseInt(totalLaki) + parseInt(totalPerempuan);
			$("#hasil").val(hasil);
		}
	</script>
</body>
</html>
