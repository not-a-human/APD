<?php
	session_start();
	
	if(isset($_SESSION['admin'])){
		$current_user = $_SESSION['admin'];
	}else{
		header("location: ../admin_login");
	}
	
	include ('../config/config.php');
	
	$page = "navPengguna";
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD | Senarai Pengguna</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php include ("../include/head.php") ?>
	<style>
		.table-responsive th{
			min-width:140px;
		}
	</style>
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
			<h2>Senarai Pengguna</h2>
			<ol>
			<li><a href="index">Home</a></li>
			<li>Senarai Pengguna</li>
			</ol>
			</div>

			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				<div class="alert alert-light border w-75 text-center mx-auto" role="alert">
				Tekan barisan yang berkenaan untuk kemaskini.
				</div>
				<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr class="text-center">
							<th scope="col">ID Pensyarah</th>
							<th scope="col">Nama</th>
							<th scope="col">No Tel</th>
							<th scope="col">Kursus</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = " SELECT * FROM pensyarah ORDER BY nama ASC;";
							$result = mysqli_query($db, $sql);
							while($row = mysqli_fetch_array($result)){
								$kursus = explode(",", $row['kursus']);
								echo '
									<tr class="text-center" onclick="location.href=\'admin_add_user?id='.$row['id_pensyarah'].'\'">
										<td scope="row">'.$row['id_pensyarah'].'</td>
										<td>'.$row['nama'].'</td>
										<td>'.$row['no_tel'].'</td><td>';
										
								for($i = 0; $i < count($kursus); $i++){
									echo "<p>".$kursus[$i]."</p>";
								}
								
								echo '
									</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
				</div>
			</div>
		</section>

	</main><!-- End #main -->

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
	<script>
	$(document).ready(function(){
		var bootstrapButton = $.fn.button.noConflict()
		$.fn.bootstrapBtn = bootstrapButton;
		
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})

	});
	</script>
</body>

</html>