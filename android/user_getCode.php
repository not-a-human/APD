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

	if(isset($_GET['m']) && isset($_GET['u'])){
		include("../config/config.php");
		$u = $_GET['u'];
		$m = $_GET['m'];
		
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
			AND id_pensyarah = '".$u."'
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
				
				$query2 = "SELECT id_tempahan, tarikh_penggunaan, masa_penggunaan FROM bilik_apd
							WHERE id_tempahan = '".$row['id_tempahan']."'
							AND id_pensyarah = '".$u."'
				";
				
				$result2 = mysqli_query($db, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				
				array_push($data, array(
					"hari" => $dayx,
					"tarikh" => $row2['tarikh_penggunaan'],
					"kod" => $row2['id_tempahan'],
					"masa" => $row2['masa_penggunaan']
				));
			}
		}else{
			array_push($data, array(
					"hari" => "",
					"tarikh" => "",
					"kod" => "tiada",
					"masa" => ""
				));
		}
		
		print_r(json_encode($data));
		
	}
?>