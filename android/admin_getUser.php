<?php
	if(true){
		include("../config/config.php");
		
		$data = array();
		$query = "SELECT nama, id_pensyarah, no_tel, kursus FROM pensyarah ORDER BY nama ASC";
		
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				
				$query2 = "SELECT COUNT(status) AS selesai
							FROM bilik_apd 
							WHERE id_pensyarah = '".$row['id_pensyarah']."'
							AND status = 'SELESAI'
				";
				$result2 = mysqli_query($db, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				
				$query3 = "SELECT COUNT(status) AS belum
							FROM bilik_apd 
							WHERE id_pensyarah = '".$row['id_pensyarah']."'
							AND status = 'BELUM'
				";
				$result3 = mysqli_query($db, $query3);
				$row3 = mysqli_fetch_assoc($result3);
				
				array_push($data, array(
					"idpen" => $row['id_pensyarah'],
					"kursus" => $row['kursus'],
					"nama" => $row['nama'],
					"notel" => $row['no_tel'],
					"selesai" => $row2['selesai'],
					"belum" => $row3['belum']
				));
			}
		}else{
			array_push($data, array(
					"idpen" => "tiada",
					"kursus" => "",
					"nama" => "",
					"notel" => "",
					"selesai" => "",
					"belum" => ""
				));
		}
		
		print_r(json_encode($data));
		
	}
?>