<?php
	function getDateWeek($year, $week){
		$h = array("Mon","Tue","Wed","Thu","Fri");
		$dateTime = new DateTime();
		$dateTime->setISODate($year, $week);
		
		for($i = 0;$i < count($h); $i++){
			
			$result[$h[$i]] = $dateTime->format('Y-m-d');
			$str = '+1 days';
			$dateTime->modify($str);
			
		}
		return $result;
	}

	if(true){
		include("../config/config.php");
		
		$status = "BELUM";
		$m = "ini";
		$today = date('Y-m-d');
		$thisweek = date('W', strtotime($today));
		$data = array();
		if($m == "depan"){
			$thisweek++;
		}
		
		$weeksdate = getDateWeek(date("Y"),$thisweek);
		
		$hx = array("Mon","Tue","Wed","Thu","Fri");
		$hari = array("Isnin","Selasa","Rabu","Khamis","Jumaat");
		
		$query = "SELECT * FROM bilik_apd 
			WHERE (bilik_apd.tarikh_penggunaan = '".$weeksdate['Mon']."'
			OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Tue']."'
			OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Wed']."'
			OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Thu']."'
			OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Fri']."')
			AND status = '".$status."'
			ORDER BY bilik_apd.tarikh_penggunaan ASC;
		;";
		
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				
				$date = $row['tarikh_penggunaan'];
				$day = date('D', strtotime($date));
				$time = $row['masa_penggunaan'] -1;
				$week = date('W', strtotime($date));
				
				for($i = 0; $i < count($hari) ; $i++){
					if($hx[$i] == $day){
						$dayx = $hari[$i];
					}
				}
				$query2 = "SELECT pensyarah.nama, pensyarah.id_pensyarah, pensyarah.no_tel, bilik_apd.masa_penggunaan, bilik_apd.id_tempahan, bilik_apd.kursus, bilik_apd.tujuan, bilik_apd.tarikh_penggunaan FROM pensyarah
							INNER JOIN bilik_apd
							ON pensyarah.id_pensyarah = bilik_apd.id_pensyarah
							WHERE bilik_apd.id_tempahan = '".$row['id_tempahan']."'
				";
				
				$result2 = mysqli_query($db, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				
				array_push($data, array(
					"hari" => $dayx,
					"tarikh" => $row2['tarikh_penggunaan'],
					"kod" => $row2['id_tempahan'],
					"masa" => $row2['masa_penggunaan'],
					"id_pensyarah" => $row2['id_pensyarah'],
					"kursus" => $row2['kursus'],
					"nama" => $row2['nama'],
					"tujuan" => $row2['tujuan'],
					"telefon" => $row2['no_tel']
				));
			}
		}else{
			array_push($data, array(
					"hari" => "",
					"tarikh" => "",
					"kod" => "tiada",
					"masa" => "",
					"id_pensyarah" => "",
					"kursus" => "",
					"nama" => "",
					"tujuan" => "",
					"telefon" => ""
				));
		}
		
		print_r(json_encode($data));
		
	}
?>