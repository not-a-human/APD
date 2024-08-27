<?php
	session_start();
	
	if(isset($_SESSION['admin'])){
		$current_user = $_SESSION['admin'];
	}else{
		header("location: ../admin_login");
	}
	
	include ('../config/config.php');
	
	$page = "navAddUser";
	if(isset($_GET['id'])){
		$page = "navPengguna";
		$idPenggunaUp = $_GET['id'];
		
		$sql = "SELECT * FROM pensyarah WHERE id_pensyarah = '".$idPenggunaUp."'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if(mysqli_num_rows($result) == 0){
			echo "<script>location.href='admin_user_list';</script>";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD | Tambah Pengguna</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php include ("../include/head.php") ?>
</head>

<body>

	<!-- ======= Mobile nav toggle button ======= -->
	<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

	<!-- ======= Header ======= -->
	<header id="header">
		<div class="d-flex flex-column">

			<div class="profile">
				<h1 class="text-light m-3"><a href="index">Admin Bilik APD</a></h1>
			</div>

			<?php
				include('../include/menu.php'); 
			?>
		</div>
	</header><!-- End Header -->

	<main id="main">

		<!-- ======= Breadcrumbs ======= -->
		<section class="breadcrumbs">
			<div class="container">

			<div class="d-flex justify-content-between align-items-center">
				<?php
					if(isset($idPenggunaUp)){
						echo '<h2>Kemaskini Pengguna</h2>';
						$linkUp = '
						<li><a href="admin_user_list">Senarai Pengguna</a></li>
						<li>'.$idPenggunaUp.'</li>
						';
					}else{
						echo '<h2>Tambah Pengguna</h2>';
						$linkUp = '<li>Tambah Pengguna</li>';
					}
					echo '
						<ol>
							<li><a href="index">Home</a></li>
							'.$linkUp.'
						</ol>
					';
				?>
			</div>

			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				<form action='' method='POST'>
					
						<div class="form-group">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputID" id="inputID" placeholder="ID Pensyarah" required value="<?php
											if(isset($_POST['inputID'])){echo $_POST['inputID'];}
											elseif(isset($idPenggunaUp)){echo $row['id_pensyarah'];}
									?>"/>
									<label for="inputID">ID Pensyarah</label>
								</div>
							</div>
						</div>
						
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Nama Pensyarah" required value="<?php
											if(isset($_POST['inputNama'])){echo $_POST['inputNama'];}
											elseif(isset($idPenggunaUp)){echo $row['nama'];}
									?>"/>
									<label for="inputNama">Nama Pensyarah</label>
								</div>
								<small id="linkHelp" class="form-text text-muted">
								Nama pendek atau panggilan sahaja
								<br/>Contoh: Sinar / Iman
								</small>
							</div>
						</div>
					
						<div class="form-group row mt-3">
							<div class="">
								<div class="form-floating">
									<input type="tel" class="form-control" name="inputTel" placeholder="No. Telefon" id="inputTel" required value="<?php
											if(isset($_POST['inputTel'])){echo $_POST['inputTel'];}
											elseif(isset($idPenggunaUp)){echo $row['no_tel'];}
									?>"/>
									<label for="inputTel">No. Telefon</label>
								</div>
								<small id="linkHelp" class="form-text text-muted">
								Contoh: +60101234567 / 0101234567
								</small>
							</div>
							
						</div>
						
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputKursus" id="inputKursus" placeholder="Kursus" required value="<?php
										
											if(isset($_POST['inputKursus'])){echo $_POST['inputKursus'];}
											elseif(isset($idPenggunaUp)){echo $row['kursus'];}
										
									?>"/>
									<label for="inputKurssu">Kursus</label>
								</div>
								<small id="linkHelp" class="form-text text-muted">
								Jika banyak, asingkan dengan ' , ' contoh : 
								<br/> Bahasa Melayu, Bahasa Inggeris, Sains
								</small>
							</div>
							
						</div>
						
		
						
						
						<div class="form-group mt-4 text-center">
						
						<?php
							if(isset($_POST['submit'])){
								$id_pen = strtoupper($_POST['inputID']);
								$kursus = $_POST['inputKursus'];
								$nama = $_POST['inputNama'];
								$notel = $_POST['inputTel'];
								
								$sql = "
								SELECT * FROM pensyarah WHERE id_pensyarah = '".$id_pen."'
								;";
								$res = mysqli_query($db, $sql);
								$count = mysqli_num_rows($res);
								
								if($count == 0){
									$sql = "INSERT INTO `pensyarah` (id_pensyarah, nama, no_tel, kursus, notifKey)
											VALUES ('".$id_pen."', '".$nama."', '".$notel."', '".$kursus."', '');
									";
									
									$result = mysqli_query($db, $sql);
									if($result){
										
										echo '
										<div class="alert alert-success">
											<strong>Success!</strong> Data berjaya dimasukkan.
										</div>
										<script>
											location.href="admin_user_list";
										</script>
										';
										
									}else{
										echo '<div class="alert alert-danger">
										  <strong>Unsuccess!</strong> Data tidak berjaya dimasukkan.
										</div>';
										echo mysqli_error($db);
									}
								}else{
									echo '<div class="alert alert-danger">
									Maaf, ID Pensyarah tersebut telah digunakan</a>.
									</div>';
								}
							}
							
							if(isset($_POST['submit-update'])){
								$id_pen = strtoupper($_POST['inputID']);
								$kursus = $_POST['inputKursus'];
								$nama = $_POST['inputNama'];
								$notel = $_POST['inputTel'];
								
								$sql = "
								UPDATE pensyarah SET
								id_pensyarah = '".$id_pen."', 
								nama = '".$nama."', 
								no_tel = '".$notel."', 
								kursus = '".$kursus."'
								WHERE id_pensyarah = '".$idPenggunaUp."'
								;";
								$res = mysqli_query($db, $sql);
								
								if($res){
									echo '
										<div class="alert alert-success">
											<strong>Success!</strong> Data berjaya dikemaskini.
										</div>
										<script>
											location.href="admin_user_list";
										</script>
										';
								}else{
									echo '<div class="alert alert-danger">
										  <strong>Unsuccess!</strong> Data tidak berjaya dikemaskini.
										</div>';
								}
							}
						?>
						</div>
						<div class="form-group row mt-3 text-center">
						<div>
						<button type="submit" class="btn btn-primary" 
						<?php
						if(isset($idPenggunaUp)){
							echo 'name="submit-update"';
						}else{
							echo 'name="submit"';
						}
						?>
						>Submit</button>
						</div>
						</div>
					</form>
			</div>
		</section>

	</main><!-- End #main -->

	<?php include('../include/footer.php'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	
	<div id="dialog" title="Alert message" style='display:none;'>
		<div class="ui-dialog-content ui-widget-content">
			<p>
				<label id="lblMessage">
				</label>
			</p>
		</div>
	</div>
	
	<!-- Vendor JS Files -->
	<script src="../assets/vendor/purecounter/purecounter.js"></script>
	<script src="../assets/vendor/aos/aos.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="../assets/vendor/typed.js/typed.min.js"></script>
	<script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
	<script src="../assets/vendor/php-email-form/validate.js"></script>
	
	<script src="../assets/vendor/jquery-ui-1.13.0.custom/jquery-ui.min.js"></script>

	<!-- Template Main JS File -->
	<script src="../assets/js/main.js"></script>
	<script>
	$(document).ready(function(){
		var bootstrapButton = $.fn.button.noConflict()
		$.fn.bootstrapBtn = bootstrapButton;
	});
	
	</script>
</body>

</html>