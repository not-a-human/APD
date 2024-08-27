<?php
	function sendFCM($notifData, $to){
		$url = 'https://fcm.googleapis.com/fcm/send';
		// //SERVER KEY
		$apiKey = "AAAAWq3AaLI:APA91bFKeu5XlnbELAh7OaLljk17CG8fUvtOJatR0lZ0KdDp0cqDSpkVWSLTADoJreEiwsPnosRlFq7aQDqrHhuhLMHM0ttcd6OeWli1QNdd7kKmZjus6imLwQWZaE61wgUiJO0EsJ5_ ";
		
		$fields = array (
			'registration_ids' => array (
					$to
			),
			'notification' => $notifData
			,'android' => array('priority' => 'high')
			)
		;

		//header includes Content type and api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$apiKey
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		print($result);
	}
?>