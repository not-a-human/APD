<?php
	/*
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "kvsa_bilik_apd";
	
	*/
	// Timezone Malaysia
	date_default_timezone_set("Asia/Kuala_Lumpur");
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "db_apd";
	
	// Connect to MySQL
	$link = mysqli_connect($host, $user, $pass);
	if(!$link){
		die('Server down');
	}
	
	// Select Database for server
	$db_select = mysqli_select_db($link, $db);
	
	// Check database exist or not
	if (!$db_select){
		// if db not exist, create new db
		$sql = 'CREATE DATABASE '.$db.';';
		if(mysqli_query($link, $sql)){
			echo "<script>console.log('Database ".$db." created successfully')</script>";
		}else{
			echo "Error creating database";
		}
	}
	mysqli_close($link);
	$db = mysqli_connect($host, $user, $pass, $db);
	
	// Check table pic_admin, exist or not
	$sql = "SELECT * FROM pic_admin";
	$result = mysqli_query($db, $sql);
	if(empty($result)){
		$sql = "CREATE TABLE pic_admin(
				username varchar(50),
				password varchar(255),
				nama_pensyarah varchar(255),
				notifKey varchar(255) DEFAULT '',
				PRIMARY KEY (username)
		)";
		$result = mysqli_query($db, $sql);
		mysqli_query($db, "INSERT INTO pic_admin (username, password, nama_pensyarah) VALUES ('admin','admin','admin');");
	}
	
	// Check table pensyarah, exist or not
	$sql = "SELECT * FROM pensyarah";
	$result = mysqli_query($db, $sql);
	if(empty($result)){
		$sql = "CREATE TABLE pensyarah(
				id_pensyarah varchar(20),
				nama varchar(255),
				no_tel varchar(20),
				kursus varchar(255),
				notifKey varchar(255) DEFAULT '',
				PRIMARY KEY (id_pensyarah)
		)";
		$result = mysqli_query($db, $sql);
	}

	// Check table bilik_apd, exist or not
	$sql = "SELECT * FROM bilik_apd";
	$result = mysqli_query($db, $sql);
	if(empty($result)){
		$sql = "CREATE TABLE bilik_apd(
				id_tempahan varchar(20),
				id_pensyarah varchar(20),
				kursus varchar(255),
				tujuan varchar(255),
				masa_tempah datetime,
				tarikh_penggunaan date,
				masa_penggunaan int(11),
				status varchar(15),
				FOREIGN KEY (id_pensyarah) 
				REFERENCES pensyarah(id_pensyarah)
				ON UPDATE CASCADE
				ON DELETE CASCADE,
				PRIMARY KEY (id_tempahan)
		)";
		$result = mysqli_query($db, $sql);
		echo mysqli_error($db);
	}
?>