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
				<h1 class="text-light m-3"><a href="index">Admin Bilik APD</a></h1>
			</div>


			<nav id="navbar" class="nav-menu navbar mt-3">
				<ul>
					<li><a href="index" id="navHome" class="nav-link"><i class="bx bx-chevron-left"></i> <span>Back</span></a></li>		
				</ul>
			</nav><!-- .nav-menu -->
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
							<input type="text" class="form-control" name="inputName" id="inputName" placeholder="Username" required>
							<label for="inputID">Username</label>
						</div>
						</div>
					</div>
					<div class="form-group mt-3">
						<div class="input-group">
						<span class="input-group-text"><i class="bi bi-key-fill"></i></span>
						<div class="form-floating">
							<input type="password" class="form-control" name="inputPass" id="inputPass" placeholder="Password" required>
							<label for="inputPass">Password</label>
						</div>
						</div>
					</div>
					<?php
						if(isset($_POST['inputName'])){
							$pass = $_POST['inputPass'];
							$username = $_POST['inputName'];
							
							// BINARY = case sensitive
							$query = "SELECT username, password from pic_admin 
										WHERE BINARY username = '".$username."' 
										AND BINARY password = '".$pass."'
							;";
												
							$result = mysqli_query($db, $query);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
							$count = mysqli_num_rows($result);
							
							if($count == 1){
								$_SESSION['admin'] = $username;
								echo '
									<script>
										location.href="admin";
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