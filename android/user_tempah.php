<?php
	session_start();
	include("../config/config.php");
	
	if(isset($_GET['x']) && isset($_GET['y']) && isset($_GET['w']) && isset($_GET['u'])){
		$masa = $_GET['x'];
		$hari = $_GET['y'];
		$week = $_GET['w'];
		$current_user = $_GET['u'];
		$minggu = $_GET['m'];
	}else{
		echo "<script>location.href='user_table';</script>";
	}
	$page = "android";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sistem Penempahan Bilik APD | Minggu</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php include ("../include/head.php") ?>
</head>

<body>
	<main id="main">
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
					
						<div class="form-group row mt-3">
							<div class="">
								<div class="form-floating">
									
									<?php
									$sql = "SELECT kursus FROM pensyarah WHERE id_pensyarah = '".$current_user."';";
									$result = mysqli_query($db, $sql);
									$row = mysqli_fetch_assoc($result);
									if($row != 0){
										echo '
											<select class="form-control mb-1" name="inputKursus" id="inputKursus"  required>
												<option value="">Sila pilih</option>
										';
										$kursus = explode(",", $row['kursus']);
										for($i = 0; $i < count($kursus); $i++){
											echo "<option value='".$kursus[$i]."'>".$kursus[$i]."</option>";
										}
										echo '</select>';
									}
									?>
									<label for="inputKursus" class="col-md-2 col-form-label">Kursus</label>
								</div>
							</div>
							
						</div>
						
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control" name="inputTujuan" id="inputTujuan" placeholder="Tujuan" required>
									<label for="inputTujuan">Tujuan</label>
								</div>
								<small id="linkHelp" class="form-text text-muted">
								Sila masukkan kelas yang akan diajar beserta tujuan.
								<br/>Contoh : 
								<br/>2 DVM IPD, tujuan pembelajaran
								</small>
							</div>
							
						</div>
						
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control	border-0 bg-light" disabled name="inputTarikh" id="inputTarikh" placeholder="ID Pensyarah" required value="<?php
											switch($hari){
												case '0' :
													echo "Isnin";
													break;
												case "1":
													echo  "Selasa";
													break;
												case "2":
													echo  "Rabu";
													break;
												case "3":
													echo  "Khamis";
													break;
												case "4":
													echo "Jumaat";
													break;
											}
										?>"/>
									<label for="inputTarikh">Tarikh Penggunaan</label>
								</div>
							</div>
						</div>
						
						<div class="form-group mt-3">
							<div class="">
								<div class="form-floating">
									<input type="text" class="form-control	border-0 bg-light" disabled name="inputMasa" id="inputMasa" placeholder="Masa Penggunaan" required value="<?php
											switch($masa){
												case '1' :
													echo "8:00 - 9:00";
													break;
												case "2":
													echo "9:00 - 10:00";
													break;
												case "3":
													echo "10:00 - 11:00";
													break;
												case "4":
													echo "11:00 - 12:00";
													break;
												case "5":
													echo "12:00 - 1:00";
													break;
												case "6":
													echo "2:00 - 3:00";
													break;
												case "7":
													echo "3:00 - 4:00";
													break;
												case "8":
													echo "4:00 - 5:00";
													break;
											}
										?>"/>
									<label for="inputMasa">Masa Penggunaan</label>
								</div>
							</div>
						</div>
						
						<div class="form-group mt-4 text-center">
						
						<?php
							if(isset($_POST['submit'])){
								
								include('../include/minggu.php');
								
								$id_pen = $current_user;
								$kursus = $_POST['inputKursus'];
								$tujuan = $_POST['inputTujuan'];
								$masa_tempah = date('Y-m-d H:i:s');
								
								$h = array("Mon","Tue","Wed","Thu","Fri");
								$string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
								$rndstr = '';
								
								for($i = 0; $i < 5 ; $i++){
									$rndstr .= substr($string, rand(0, 36), 1);
								}
								
								$sql = "SELECT id_tempahan FROM bilik_apd;";
								$result = mysqli_query($db, $sql);
								while($row = mysqli_fetch_array($result)){
									if($rndstr == $row['id_tempahan']){
										for($i = 0; $i < 5 ; $i++){
											$rndstr .= substr($string, rand(0, 36), 1);
										}
									}
								}
								
								$id_tem = $rndstr;
								
								$weeksdate = getDateWeek(date("Y"),$week);
								
								$tarikh = $weeksdate[$h[$hari]];
				
								$sql = "
								SELECT * FROM bilik_apd WHERE masa_penggunaan = '".$masa."' AND tarikh_penggunaan = '".$tarikh."'
								;";
								$res = mysqli_query($db, $sql);
								$count = mysqli_num_rows($res);
								
								if($count == 0){
				
									$sql = "INSERT INTO `bilik_apd` 
											(id_tempahan, id_pensyarah, kursus, tujuan, masa_tempah, tarikh_penggunaan, masa_penggunaan, status)
											VALUES ('".$id_tem."', '".$id_pen."', '".$kursus."', '".$tujuan."', '".$masa_tempah."', '".$tarikh."', '".$masa."', 'BELUM');
									";
									
									$result = mysqli_query($db, $sql);
									if($result){
										include("../include/android_notification.php");
										
										// User notification
										$sql = "SELECT notifKey from pensyarah WHERE id_pensyarah = '".$id_pen."';";
										$result = mysqli_query($db,$sql);
										$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
										$notifData = array(
											'title' => 'Kod Verifikasi Bilik APD',
											'body' => 'Kod Verifikasi ialah '.$id_tem.' bagi penempahan yang baru dibuat',
											'sound' => 'default',
											'click_action' => 'android.intent.action.details'
										);
										
										sendFCM($notifData, $row['notifKey']);
										
										// Admin notification
										$sql = "SELECT notifKey from pic_admin WHERE username = 'admin';";
										$result = mysqli_query($db,$sql);
										$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
										
										$notifData = array(
											'title' => 'APD ADMIN',
											'body' => $id_pen.' telah berjaya membuat penempahan untuk '.$tarikh.' pada masa ke-'.$masa,
											'sound' => 'default',
											'click_action' => 'android.intent.action.details'
										);
										
										sendFCM($notifData, $row['notifKey']);
										
										echo '
										<div class="alert alert-success">
											<strong>Success!</strong> Data berjaya dimasukkan.
										</div>
										<script>
											location.href="user_table?m='.$minggu.'&u='.$current_user.'";
										</script>
										';
									}else{
										echo '<div class="alert alert-danger">
										  <strong>Unsuccess!</strong> Data tidak berjaya dimasukkan.
										</div>';
									}
								}else{
									echo '<div class="alert alert-danger">
									Maaf, telah ada penempahan yang telah dibuat pada tarikh dan masa yang sama, sila <a class="alert-link" href="user_table?u='.$current_user.'&m='.$minggu.'">kembali</a>.
									</div>';
								}
							}
						?>
					</div>
					<div class="form-group row mt-3 text-center">
						<div>
							<button type="submit" class="btn btn-primary" name="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</section>

	</main><!-- End #main -->

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
	});
	
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	</script>
</body>

</html>