<?php
	if(isset($_POST['id_admin']) && isset($_POST['pass']) && isset($_POST['token'])){
		include("../config/config.php");
		$idadmin = $_POST["id_admin"];
		$pass = $_POST["pass"];
		$token = $_POST['token'];
		
		// BINARY = case sensitive
		$query = "SELECT username, password from pic_admin 
					WHERE BINARY username = '".$idadmin."' 
					AND BINARY password = '".$pass."'
		;";
			
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		
		if($count == 1){
			$sql = "UPDATE `pic_admin`
				SET notifKey = '".$token."'
				WHERE username = '".$idadmin."';
			";
			$result = mysqli_query($db,$sql);
			if($result){
				echo "Success";
			}else{
				echo "Error";
			}
		}else{
			echo "Failed";
		}
	}	
?>