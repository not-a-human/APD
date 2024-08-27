<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="author" content="Avie Sinar, Izz Dayini">

<meta property="og:image" content="/assets/img/photo_2021-11-15_20-54-04.jpg">
<meta property="og:description" content="Sistem untuk menempah Bilik APD di Kolej Vokasional Shah Alam (KVSA)">
<meta property="og:title" content="Sistem Penempahan Bilik APD">

<meta property="twitter:image" content="/assets/img/photo_2021-11-15_20-54-04.jpg">
<meta property="twitter:description" content="Sistem untuk menempah Bilik APD di Kolej Vokasional Shah Alam (KVSA)">
<meta property="twitter:title" content="Sistem Penempahan Bilik APD">
  
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<?php
	if(isset($page)){

		if(isset($page)){
			if($page == 'android'){
				$xLink = "../";
			}elseif($page == 'navThisWeek-non' || $page == 'navNextWeek-non'){
				$xLink = "";
			}else{
				if(isset($_SESSION['admin'])){
					$xLink = "../";	
				}else{
					$xLink = "";	
				}
			}
		}
		
		if(isset($pageIndex)){
			$xLink = "";
		}
		
	}else{
		$xLink = "";
	}
	echo '
		<!-- Favicons -->
		<link href="'.$xLink.'assets/img/ic_launcher.png" rel="icon">
		<link href="'.$xLink.'assets/img/ic_launcher.png" rel="apple-touch-icon">
	
		<!-- Vendor CSS Files -->
		<link href="'.$xLink.'assets/vendor/aos/aos.css" rel="stylesheet">
		<link href="'.$xLink.'assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="'.$xLink.'assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="'.$xLink.'assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="'.$xLink.'assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="'.$xLink.'assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

		<!-- Template Main CSS File -->
		<link href="'.$xLink.'assets/css/style.css" rel="stylesheet">

		<script src="'.$xLink.'assets/vendor/jquery/jquery-3.4.1.min.js"></script>
	';
?>
<!-- =======================================================
* Template Name: iPortfolio - v3.7.0
* Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->

<style>
	.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
		background-color: #149ddd !important;
		border-color: #149ddd !important;
	}
</style>