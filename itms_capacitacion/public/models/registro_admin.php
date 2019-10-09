<?php  

	class Registro_admin{
		public function registrar_admin($tdocumento, $documento, $nombres, $apellidos, $correo, $password){

			include("../../public/models/conexion.php");

			$cont = "0";

			$nombres = strtoupper($nombres);
			$apellidos = strtoupper($apellidos);
			$rol = 2;
			$pass_cifrada = password_hash($password, PASSWORD_DEFAULT); 

			$sql = "SELECT * FROM usuarios WHERE documento = '$documento'";

			if(!$result = $db ->query($sql)){
				die ('Ya existe un registro con ese documento [' .$db->error .']');
			}

			while($row = $result -> fetch_assoc()){
				$ddocumento = stripcslashes($row["documento"]);
				$cont = $cont + 1;
			}

			if ($cont == "0") {
				
				include("../alerts/alerta_s_registro.html");

				$sql2 = "INSERT INTO usuarios (rol, tipo_documento, documento, nombres, apellidos, correo, password) VALUES ('$rol', '$tdocumento', '$documento', '$nombres', '$apellidos', '$correo', '$pass_cifrada')";

				if(!$result2 = $db->query($sql2)){
 					die('Hay un error corriendo en la consulta [' . $db->error . ']');
				}
				
			}else{
				include("../alerts/alerta_d_registro.html");
			}
		}
	}

	$nuevo = new Registro_admin();
	$nuevo -> registrar_admin($_POST["tdocumento"], $_POST["documento"], $_POST["nombres"], $_POST["apellidos"], $_POST["correo"], $_POST["password"]);

?>