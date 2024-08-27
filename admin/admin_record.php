<?php
	session_start();
	
	if(isset($_SESSION['admin'])){
		$current_user = $_SESSION['admin'];
	}else{
		header("location: ../admin_login");
	}
	
	include ('../config/config.php');
	
	$page = "navRekodTempahan";
?>
<!DOCTYPE html>
<html lang="ms">

<head>
	<title>Sistem Penempahan Bilik APD | Senarai Pengguna</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php include ("../include/head.php") ?>
	<style>
		#table-x th{
			min-width: 140px;
		}
		#viewBtnGroup .active{
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
			<h2>Rekod Tempahan</h2>
			<ol>
			<li><a href="index">Home</a></li>
			<li>Rekod Tempahan</li>
			</ol>
			</div>

			</div>
		</section><!-- End Breadcrumbs -->

		<section class="inner-page">
			<div class="container">
				<div class="w-75 text-center mx-auto mb-4">
					<?php
						$viewType='card';
						if(isset($_GET['view'])){
							$viewType = $_GET['view'];
							
						}
					?>
					<form action='' method='GET'>
						<div class="input-group mb-4">
							<input type="hidden" name="view" value="<?php echo $viewType; ?>"/>
							<input type="search" name="s" class="form-control" placeholder="Search">
							<button type="submit" class="btn btn-primary">
						<span class="bi bi-search"></span>
						</div>
						</button>
					</form>

					<div class="">
						<div id="viewBtnGroup" class="btn-group">
							<?php
								$tableViewLink = "?view=table";
								$cardViewLink = "?view=card";
								if(isset($_GET['s'])){
									$getSearchParam = "&s=".trim($_GET['s']);
									$tableViewLink .= $getSearchParam;
									$cardViewLink .= $getSearchParam;
								}
								echo '
								<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Table View" href="'.$tableViewLink.'" id="table-view" class="btn btn-primary"><i class="bi bi-table"></i></a>
								<a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Card View" href="'.$cardViewLink.'" id="card-view" class="btn btn-primary"><i class="bi bi-card-list"></i></a>
								';
								if($viewType == 'table'){
									echo "<script>
										$('#viewBtnGroup #table-view').addClass('disabled');
									</script>";
								}else{
									echo "<script>
										$('#viewBtnGroup #card-view').addClass('disabled');
									</script>";
								}
							?>
						</div>
      				</div>

				</div>
				<?php
					if(isset($_GET['s'])){
						$x = trim($_GET['s']);
						$sql = " SELECT bilik_apd.id_pensyarah, bilik_apd.id_tempahan, bilik_apd.kursus, bilik_apd.tujuan, bilik_apd.tarikh_penggunaan, bilik_apd.status, pensyarah.nama 
						FROM bilik_apd
						INNER JOIN pensyarah 
						ON bilik_apd.id_pensyarah = pensyarah.id_pensyarah
						WHERE (bilik_apd.id_tempahan LIKE '%$x%')
						OR (bilik_apd.id_pensyarah LIKE '%$x%')
						OR (bilik_apd.kursus LIKE '%$x%')
						OR (bilik_apd.tujuan LIKE '%$x%')
						OR (bilik_apd.tarikh_penggunaan LIKE '%$x%')
						OR (bilik_apd.status LIKE '%$x%')
						OR (pensyarah.nama LIKE '%$x%')
						ORDER BY tarikh_penggunaan ASC;";
						echo "<script type='text/javascript'>
							$('input[type=search]').val('".$x."');
						</script>";
					}else{
						$sql = " SELECT * FROM bilik_apd 
						INNER JOIN pensyarah 
						ON bilik_apd.id_pensyarah = pensyarah.id_pensyarah
						ORDER BY tarikh_penggunaan ASC
						;";
					}
					$result = mysqli_query($db, $sql);
					echo mysqli_error($db);
					if(mysqli_num_rows($result) > 0){
						if(isset($_GET['view'])){
							$viewType = $_GET['view'];

							if($viewType == 'table'){
								echo '
									<div class="table-responsive">
										<table id="table-x" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th class="text-center">ID Tempahan</th>
													<th class="text-center">ID Pensyarah</th>
													<th class="text-center">Nama Pensyarah</th>
													<th class="text-center">Kursus</th>
													<th class="text-center">Tujuan</th>
													<th class="text-center">Tarikh Penggunaan</th>
												</tr>
											</thead>
											<tbody>
								';

								while($row = mysqli_fetch_array($result)){
									echo '
										<tr>
											<td>'.$row['id_tempahan'].'</td>
											<td>'.$row['id_pensyarah'].'</td>
											<td>'.$row['nama'].'</td>
											<td>'.$row['kursus'].'</td>
											<td>'.$row['tujuan'].'</td>
											<td>'.$row['tarikh_penggunaan'].'</td>
										</tr>
									';
								}

								echo '
											</tbody>
										</table>
									</div>
								';
							}else{
								while($row = mysqli_fetch_array($result)){
									echo '
										<div class="card card-body mb-3">
											<div class="mb-1">ID Tempahan: '.$row['id_tempahan'].'</div>
											<div class="mb-1">ID Pensyarah: '.$row['id_pensyarah'].'</div>
											<div class="mb-1">Nama Pensyarah: '.$row['nama'].'</div>
											<div class="mb-1">Kursus: '.$row['kursus'].'</div>
											<div class="mb-1">Tujuan: '.$row['tujuan'].'</div>
											<div class="mb-1">Tarikh Penggunaan: '.$row['tarikh_penggunaan'].'</div>
										</div>
									';
								}
							}
						}else{
							while($row = mysqli_fetch_array($result)){
								echo '
									<div class="card card-body mb-3">
										<div class="mb-1">ID Tempahan: '.$row['id_tempahan'].'</div>
										<div class="mb-1">ID Pensyarah: '.$row['id_pensyarah'].'</div>
										<div class="mb-1">Nama Pensyarah: '.$row['nama'].'</div>
										<div class="mb-1">Kursus: '.$row['kursus'].'</div>
										<div class="mb-1">Tujuan: '.$row['tujuan'].'</div>
										<div class="mb-1">Tarikh Penggunaan: '.$row['tarikh_penggunaan'].'</div>
									</div>
								';
							}
						}
					}else{
						echo '<div class="mt-4 mb-4 text-center">Tiada data yang dijumpai, sila cuba lagi</div>';
					}
				?>
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