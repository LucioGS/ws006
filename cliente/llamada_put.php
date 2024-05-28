<?php

	$url = "localhost/000servicios/006/servidor/index.php/usuario/7";
	
	$url = str_replace(' ', '%20', $url);
	$data = array(
		'nombre' => 'Jorge',
		'apellidos' => 'Campillo Mesas',
		'telefono' => '666554433',
		'email' => 'erewrwe@ddsjj.es',
		'direccion' => 'Orujo 12',
		'localidad' => 'Alcobendas',
		'user' => 'campillo',
		'password' => 'zzz',
		'perfil' => '2'	
	);
	$payload = json_encode(array("datos" => $data));
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$data = curl_exec($curl);
	curl_close($curl);
	$data_convertido = json_decode($data, true);
	print_r($data_convertido);
	
?>


