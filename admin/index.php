<?php
	session_start();
	include ('../config/config.php');
	
	if(isset($_SESSION['admin'])){
		$current_user = $_SESSION['admin'];
	}else{
		header("location: ../admin_login");
	}
	$page = "navHome";
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Admin</title>
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

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
		<div class="hero-container" data-aos="fade-in">
		<h1>Sistem Penempahan</h1>
		<?php
		if(isset($current_user)){
			echo '<p class="text-center"><span class="typed" data-typed-items="Bilik APD"></span></p>';
		}else{
			echo '<p class="text-center"><a href="user_login"><span class="typed" data-typed-items="Bilik APD , Log In"></span></a></p>';
		}
		?>
		</div>
	</section><!-- End Hero -->

	<?php include('../include/footer.php'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	
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

</body>

</html>