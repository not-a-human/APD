<?php
	session_start();
	
	if(isset($_SESSION['pensyarah'])){
		$current_user = $_SESSION['pensyarah'];
	}
	
	include ('config/config.php');
	$page = "navVerifyOut";
	
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD | Verify</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php include ("include/head.php") ?>
</head>

<body>

	<!-- ======= Mobile nav toggle button ======= -->
	<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

	<!-- ======= Header ======= -->
	<header id="header">
		<div class="d-flex flex-column">

			<div class="profile">
				<h1 class="text-light m-3"><a href="index">Bilik APD</a></h1>
			</div>

			<?php
				include('include/menu.php'); 
			?>
		</div>
	</header><!-- End Header -->

	<main id="main">

		<!-- ======= Breadcrumbs ======= -->
		<section class="breadcrumbs">
			<div class="container">

			<div class="d-flex justify-content-between align-items-center">
			<h2>Verify (Check Out)</h2>
			<ol>
			<li><a href="index">Home</a></li>
			<li>Verify (Check Out)</li>
			</ol>
			</div>

			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				<form action='' method='POST'>
					
						<div class="form-group">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputID" id="inputID" placeholder="ID Pensyarah" required disabled value="<?php echo $current_user; ?>"/>
									<label for="inputID">ID Pensyarah</label>
								</div>
							</div>
						</div>
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputKod" id="inputKod" placeholder="Kod Verifikasi" required value="<?php if(isset($_POST["inputKod"])){echo $_POST["inputKod"];}  ?>">
									<label for="inputKod">Kod Verifikasi</label>
								</div>
								<small id="linkHelp" class="form-text text-muted">
								Kod verifikasi yang telah dimasukkan semasa membuat <span class="fst-italic">Check In</span> tadi
								</small>
							</div>
						</div>
						
						<div class="form-group mt-4 text-center">
						
						<?php
							function printError(){
								echo '<div class="alert alert-danger">
									Maaf, kod tidak sah, sila <a href="user_minggu" class="alert-link">tempah</a> untuk mendapatkan kod.
									</div>';
							}
							if(isset($_POST['submit'])){
								$kodVerifikasi = $_POST['inputKod'];
								
								$sql = "SELECT * FROM bilik_apd WHERE id_tempahan = '".$kodVerifikasi."' AND status = 'PENDING';";
								$result = mysqli_query($db, $sql);
								if(mysqli_num_rows($result) == 1){
    								$sql = "UPDATE bilik_apd SET status = 'SELESAI' WHERE id_tempahan = '".$kodVerifikasi."' AND status = 'PENDING';";
    								$result = mysqli_query($db, $sql);
    								if($result){
    									echo '<div class="alert alert-success">
    									Kod telah berjaya disahkan, terima kasih kerana menggunakan sistem ini.
    									</div>';
    								}else{
    									echo '<div class="alert alert-danger">
    									Maaf, table db tidak dapat dikemaskini, sila hubungi PIC (Person In Charge).
    									</div>';
							    	}
								}else{
									echo '<div class="alert alert-danger">
									Maaf, kod telah digunakan atau belum <a href="verify" class="alert-link">check in</a> lagi, Sila hubungi PIC (Person In Charge), jika masalah berterusan.
									</div>';
								}
							}
						?>
					</div>
					<div class="form-group row mt-3 text-center">
						<div>
							<button type="submit" class="btn btn-primary" name="submit">Check Out</button>
						</div>
					</div>
				</form>
			</div>
		</section>

	</main><!-- End #main -->

	<?php include('include/footer.php'); ?>

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
	<script src="assets/vendor/purecounter/purecounter.js"></script>
	<script src="assets/vendor/aos/aos.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="assets/vendor/typed.js/typed.min.js"></script>
	<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
	<script src="assets/vendor/php-email-form/validate.js"></script>
	
	<script src="assets/vendor/jquery-ui-1.13.0.custom/jquery-ui.min.js"></script>

	<!-- Template Main JS File -->
	<script src="assets/js/main.js"></script>
	<script>
	$(document).ready(function(){
		var bootstrapButton = $.fn.button.noConflict()
		$.fn.bootstrapBtn = bootstrapButton;
	});
	</script>
</body>

</html>