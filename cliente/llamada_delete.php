<?php

	$url = "localhost/000servicios/006/servidor/index.php/usuario/15";
	
	$url = str_replace(' ', '%20', $url);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$data = curl_exec($curl);
	curl_close($curl);
	$data_convertido = json_decode($data, true);
	print_r($data_convertido);
	
?>


