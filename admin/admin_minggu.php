<?php
	session_start();
	
	if(isset($_SESSION['admin'])){
		$current_user = $_SESSION['admin'];
	}else{
		header("location: ../admin_login");
	}
	
	include ('../config/config.php');
	
	$today = date('Y-m-d');
	$thisweek = date('W', strtotime($today));
	
	$minggu = "ini";
	$page = "navThisWeek";
	if (isset($_GET['m'])){
		$x = $_GET['m'];
		if($x == "depan" || $x == 'hadapan'){
			$thisweek++;
			$minggu = "hadapan";
			$page = "navNextWeek";
		}
	}
	
	include("../include/minggu.php");
	$jadual = minggu($thisweek, false);
	
	$hari = array("M","T","W","T","F");
	$h_panjang = array("Mon","Tue","Wed","Thu","Fri");
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD | Minggu</title>
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
			<h2>Minggu <?php echo $minggu; ?></h2>
			<ol>
			<li><a href="index">Home</a></li>
			<li>Minggu <?php echo $minggu; ?></li>
			</ol>
			</div>

			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				<div class="alert alert-light border w-75 text-center mx-auto" role="alert">
				Sila tekan pada ruangan kosong untuk menempah.
				</div>
				<div class="table-responsive-lg">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr class="text-center">
							<td scope="col" style="border: none;"></td>
							<td scope="col">1</td>
							<td scope="col">2</td>
							<td scope="col">3</td>
							<td scope="col">4</td>
							<td scope="col">5</td>
							<td scope="col">6</td>
							<td scope="col">7</td>
							<td scope="col">8</td>
						</tr>
						<tr class="text-center">
							<td style="border: none;background:white;"></td>
							<td class="">8:00 - 9:00</td>
							<td>9:00 - 10:00</td>
							<td>10:00 - 11:00</td>
							<td>11:00 - 12:00</td>
							<td>12:00 - 1:00</td>
							<td>2:00 - 3:00</td>
							<td>3:00 - 4:00</td>
							<td>4:00 - 5:00</td>
						</tr>
					</thead>
					<tbody>
						<?php
						for($i = 0;$i < count($hari);$i++ ){
							echo "
								<tr class='text-center'>
									<td class='border'>".$hari[$i]."</td>
							";
							for ($col = 0; $col < 8; $col++) {
								$valid = $jadual[$h_panjang[$i]][$col];
								if($valid == "-"){
									echo "<td class='border p-0 align-middle'><a href='admin_tempah?x=".($col+1)."&y=".$i."&w=".$thisweek."&m=".$minggu."'>
									<div class='w-100 h-100 pt-1 pb-1 m-auto'>&nbsp;</div>
									</a></td>";
								}else{
									$row = explode('| ', $valid);
									
									echo "
									<td class='align-middle ' data-bs-toggle='tooltip' data-bs-placement='bottom' data-bs-html='true' title='Kod: ".$row[3]."<br/>NoTel: ".$row[2]."'>
									<a class='text-dark' role='button' aria-expanded='false' aria-controls='info-".$row[4]."' data-bs-toggle='collapse' href='#info-".$row[4]."'>".$row[0]."</a>
									</td>
									";
								}
							}
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
				<div id="collapseParent">
				<?php
				for($i = 0;$i < count($hari);$i++ ){
					for ($col = 0; $col < 8; $col++) {
						$valid = $jadual[$h_panjang[$i]][$col];
						if($valid != "-"){
							$row = explode('| ', $valid);
							echo "
								<div class='collapse mb-3 mt-3' data-bs-parent='#collapseParent' id='info-".$row[4]."'>
								<div class='card card-body'>
								<p>Nama: ".$row[0]."</p>
								<p>No Tel: ".$row[2]."</p>
								<p>Kursus: ".$row[5]."</p>
								<p>Tujuan: ".$row[6]."</p>
								<p>Tarikh: ".$row[7]."</p>
							";
							if(isset($current_user)){
								if($row[1] == $current_user){
									echo "
										<p>Kod Verifikasi: ".$row[3]."</p>
									";
								}
							}
							echo "
							</div>
							</div>";
						}
					}
				}
				?>
				</div>
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