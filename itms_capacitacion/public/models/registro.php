<?php  

	class Registro{
		public function registrar($tdocumento, $documento, $nombres, $apellidos, $correo, $password){

			include("../../public/models/conexion.php");

			$cont = "0";

			$nombres = strtoupper($nombres);
			$apellidos = strtoupper($apellidos);
			$rol = 1;
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
				
				include("../alerts/modal_s_registro.php");

				$sql2 = "INSERT INTO usuarios (rol, tipo_documento, documento, nombres, apellidos, correo, password) VALUES ('$rol', '$tdocumento', '$documento', '$nombres', '$apellidos', '$correo', '$pass_cifrada')";

				if(!$result2 = $db->query($sql2)){
 					die('Hay un error corriendo en la consulta [' . $db->error . ']');
				}
				
			}else{
				include("../alerts/modal_d_registro.php");
			}
		}
	}

	$nuevo = new Registro();
	$nuevo -> registrar($_POST["tdocumento"], $_POST["documento"], $_POST["nombres"], $_POST["apellidos"], $_POST["correo"], $_POST["password"]);

?>