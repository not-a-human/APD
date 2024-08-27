<?php
	if(isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['notel']) && isset($_POST['kursus'])){
		
		include("../config/config.php");
		$id_pen = strtoupper($_POST['id']);
		$nama = $_POST['nama'];
		$notel = $_POST['notel'];
		$kursus = $_POST['kursus'];
			
		$query = "SELECT id_pensyarah from pensyarah
					WHERE id_pensyarah = '".$id_pen."' 
		;";
			
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		
		if($count == 0){
			$sql = "INSERT INTO pensyarah (id_pensyarah, nama, no_tel, kursus, notifKey)
					VALUES ('".$id_pen."', '".$nama."', '".$notel."', '".$kursus."', ' ');
			";
			$result2 = mysqli_query($db,$sql);
			
			if($result2){
				echo "Success";
			}else{
				echo $sql;
				echo "Failed". mysqli_error($db);
			}
		}else{
			echo "Data 1";
		}
	}
?>