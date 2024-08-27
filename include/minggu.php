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
	
	function minggu($thisweek, $android){
		
		if(isset($_SESSION['admin']) || $android == true){
			include ('../config/config.php');
		}else{
			include ('config/config.php');
		}
		
		$weeksdate = getDateWeek(date("Y"),$thisweek);
		
		$bil = 1;
		$jadual = array(
		'Mon' => array("-","-","-","-","-","-","-","-"),
		'Tue' => array("-","-","-","-","-","-","-","-"),
		'Wed' => array("-","-","-","-","-","-","-","-"),
		'Thu' => array("-","-","-","-","-","-","-","-"),
		'Fri' => array("-","-","-","-","-","-","-","-")
		);
		
		$query = "SELECT * FROM bilik_apd 
					WHERE bilik_apd.tarikh_penggunaan = '".$weeksdate['Mon']."'
					OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Tue']."'
					OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Wed']."'
					OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Thu']."'
					OR bilik_apd.tarikh_penggunaan = '".$weeksdate['Fri']."'
		;";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0){
			$numb = 1;
			while($row = mysqli_fetch_array($result)){
				
				$date = $row['tarikh_penggunaan'];
				$day = date('D', strtotime($date));
				$time = $row['masa_penggunaan'] -1;
				$week = date('W', strtotime($date));
				
				$query2 = "SELECT pensyarah.nama, pensyarah.id_pensyarah, pensyarah.no_tel, bilik_apd.id_tempahan, bilik_apd.kursus, bilik_apd.tujuan, bilik_apd.tarikh_penggunaan FROM pensyarah
							INNER JOIN bilik_apd
							ON pensyarah.id_pensyarah = bilik_apd.id_pensyarah
							WHERE bilik_apd.id_tempahan = '".$row['id_tempahan']."'
				";
				$result2 = mysqli_query($db, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				
				$jadual[$day][$time] = $row2['nama']."| ".$row2['id_pensyarah']."| ".$row2['no_tel']."| ".$row2['id_tempahan']."| ".$numb."| ".$row2['kursus']."| ".$row2['tujuan']."| ".$row2['tarikh_penggunaan'];
				$numb++;
			}
		}
		return $jadual;
	}
?>