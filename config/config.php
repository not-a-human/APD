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
	
	// Section : DB

	try {
		// Select Database for server
		$db_select = mysqli_select_db($link, $db);
		
		// Check database exist or not
		if (!$db_select){
			// if db not exist, throw exeption
			throw new Exception('Database does not exist');
		}
	} catch (Exception $e) {
		$sql = 'CREATE DATABASE '.$db.';';
		if(mysqli_query($link, $sql)){
			echo "<script>console.log('Database ".$db." created successfully')</script>";
		}else{
			echo "Error creating database";
		}
	}
	
	// Close server connection and reconnect with db

	mysqli_close($link);
	$db = mysqli_connect($host, $user, $pass, $db);

	// Section : Table

	try {

		// Check if the tables exists
		$sql = "SELECT * FROM pic_admin";
		$result = mysqli_query($db, $sql);
		if(!$result){ throw new Exception('Table pic_admin does not exist.'); }

		$sql = "SELECT * FROM pensyarah";
		$result = mysqli_query($db, $sql);
		if(!$result){ throw new Exception('Table pensyarah does not exist.'); }

		$sql = "SELECT * FROM bilik_apd";
		$result = mysqli_query($db, $sql);
		if(!$result){ throw new Exception('Table bilik_apd does not exist.'); }

	} catch (Exception $e) {
		// Handle the exception by creating the missing tables

		if(strpos($e->getMessage(), 'pic_admin') !== false){
			$sql = "CREATE TABLE pic_admin(
					username varchar(50),
					password varchar(255),
					nama_pensyarah varchar(255),
					notifKey varchar(255) DEFAULT '',
					PRIMARY KEY (username)
			)";
			if(mysqli_query($db, $sql)){
				$sql = "INSERT INTO pic_admin (username, password, nama_pensyarah) 
						VALUES ('sm','sm','Saleh Mikan');
				";
				mysqli_query($db, $sql);
			}else{
				echo "Error creating table pic_admin: " . mysqli_error($db);
			}
		}

		if(strpos($e->getMessage(), 'pensyarah') !== false){
			$sql = "CREATE TABLE pensyarah(
					id_pensyarah varchar(20),
					nama varchar(255),
					no_tel varchar(20),
					kursus varchar(255),
					notifKey varchar(255) DEFAULT '',
					PRIMARY KEY (id_pensyarah)
			)";
			if(!mysqli_query($db, $sql)){
				echo "Error creating table pensyarah: " . mysqli_error($db);
			}
		}

		if(strpos($e->getMessage(), 'bilik_apd') !== false){
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
			if(!mysqli_query($db, $sql)){
				echo "Error creating table bilik_apd: " . mysqli_error($db);
			}
		}
	}
?>