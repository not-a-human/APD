<?php
	session_start();
	include ('config/config.php');
	
	if(isset($_SESSION['admin'])){
		header("location: admin");
	}
	
	if(isset($_SESSION['pensyarah'])){
		header("location: user_minggu");
	}
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD</title>
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
				$page = "navLogIn";
				include('include/menu.php'); 
			?>
		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
		<div class="hero-container" data-aos="fade-in">
			<div class="container bg-light p-3 px-4 rounded">
				<form action="" method="post" role="form">	
					<div class="form-group mt-3">
						<div class="input-group">
						<span class="input-group-text"><i class="bi bi-person"></i></span>
						<div class="form-floating">
							<input type="text" class="form-control" name="inputID" id="inputID" placeholder="ID Pensyarah" required>
							<label for="inputID">ID Pensyarah</label>
						</div>
						</div>
					</div>
					<div class="form-group mt-3">
						<div class="input-group">
						<span class="input-group-text"><i class="bi bi-person-circle"></i></span>
						<div class="form-floating">
							<input type="text" class="form-control" name="inputNama" id="inputNama" placeholder="Nama" required>
							<label for="inputNama">Nama</label>
						</div>
						</div>
					</div>
					<?php
						if(isset($_POST['inputID'])){
							$id_pen = strtoupper($_POST['inputID']);
							$nama = $_POST['inputNama'];
							
							$query = "SELECT id_pensyarah, nama from pensyarah
										WHERE id_pensyarah = '".$id_pen."' 
										AND nama = '".$nama."'
							;";
							
							$result = mysqli_query($db, $query);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
							$count = mysqli_num_rows($result);
							
							if($count == 1){
								$_SESSION['pensyarah'] = $id_pen;
								echo '
									<script>
										location.href="user_minggu";
									</script>
								';
							}else{
								echo '
								<div class="mw-100 mt-3 text-center" role="alert">
								<small class="text-danger">
									Maklumat yang dimasukkan salah!
								</small>
								</div>
								';
							}
						}
					?>
					<div class="text-center mt-4">
						<button class="btn btn-primary w-75" type="submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</section><!-- End Hero -->

	<?php include('include/footer.php'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	
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

</body>

</html>