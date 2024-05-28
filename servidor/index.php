<?php

	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri = explode( '/', $uri );
	
	if ($uri[5] == "usuario"){
		
		if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'GET') {
			if (!isset($uri[6])){
				$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
				$usuarios = $mbd->query('SELECT * FROM usuarios');
				$array = $usuarios->fetchAll(PDO::FETCH_ASSOC);
				respuesta(200, "OK", $array);
			}else{
				$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
				$usuarios = $mbd->query('SELECT * FROM usuarios WHERE id='.$uri[6]);
				$array = $usuarios->fetch(PDO::FETCH_ASSOC);
				respuesta(200, "OK", $array);	
			}
		}
		
		if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'POST') {
			$data = json_decode(file_get_contents('php://input'), true);
			$nombre = $data["datos"]["nombre"];
			$apellidos = $data["datos"]["apellidos"];
			$telefono = $data["datos"]["telefono"];
			$email = $data["datos"]["email"];
			$direccion = $data["datos"]["direccion"];
			$localidad = $data["datos"]["localidad"];
			$user = $data["datos"]["user"];
			$password = $data["datos"]["password"];
			$perfil = $data["datos"]["perfil"];		
			$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
			$sql = "INSERT INTO usuarios (nombre, apellidos, telefono, email, direccion, localidad, user, password, perfil) VALUES (?,?,?,?,?,?,?,?,?)";
			$mbd->prepare($sql)->execute([$nombre, $apellidos, $telefono, $email, $direccion, $localidad, $user, $password, $perfil]);
		}
		
		if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'DELETE') {		
			$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');	
			$usuario = $mbd->prepare("DELETE FROM usuarios WHERE id = ?");
			$usuario->execute([$uri[6]]);
		}
		
		if (strtoupper($_SERVER["REQUEST_METHOD"]) == 'PUT') {
			$data = json_decode(file_get_contents('php://input'), true);
			$nombre = $data["datos"]["nombre"];
			$apellidos = $data["datos"]["apellidos"];
			$telefono = $data["datos"]["telefono"];
			$email = $data["datos"]["email"];
			$direccion = $data["datos"]["direccion"];
			$localidad = $data["datos"]["localidad"];
			$user = $data["datos"]["user"];
			$password = $data["datos"]["password"];
			$perfil = $data["datos"]["perfil"];		
			$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
			$sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, telefono = ? , email = ? , direccion = ? , localidad = ? , user = ? , password = ? , perfil = ? WHERE id = ?";
			$mbd->prepare($sql)->execute([$nombre, $apellidos, $telefono, $email, $direccion, $localidad, $user, $password, $perfil, $uri[6]]);
		}
		
	}
	
	
    function respuesta($estado, $mensaje_estado, $datos){
		
		header("Content-Type:application/json");
        header("HTTP/1.1 $estado $mensaje_estado");
        $respuesta['estado'] = $estado;
        $respuesta['mensaje_estado'] = $mensaje_estado;
        $respuesta['datos'] = $datos;
        $respuesta_json = json_encode($respuesta);
        echo $respuesta_json;
		
    }
  
?>