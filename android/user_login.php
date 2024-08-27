<?php
	if(isset($_POST['id_pen']) && $_POST['nama'] && $_POST['token']){
		include("../config/config.php");
		$idpen = $_POST["id_pen"];
		$nama = $_POST["nama"];
		$token = $_POST['token'];
		
		$query = "SELECT id_pensyarah, nama from pensyarah
					WHERE id_pensyarah = '".$idpen."' 
					AND nama = '".$nama."'
		;";
			
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		
		if($count == 1){
			$sql = "UPDATE `pensyarah`
				SET notifKey = '".$token."'
				WHERE id_pensyarah = '".$idpen."';
			";
			$result = mysqli_query($db,$sql);
			echo "Success";
		}else{
			echo "Failed";
		}
	}	
?>