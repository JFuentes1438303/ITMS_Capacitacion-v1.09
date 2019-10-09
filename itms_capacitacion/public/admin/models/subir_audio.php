<?php  

	class Audio{
		public function subir_audio($nombre){

			session_start();

			$ruta = "../../../temporal/audios/";
			$nombre_audio = $_POST["nombre"];
			$nombre_audio = strtoupper($nombre_audio);
			$tipo_audio = $_FILES["archivo_audio"]["type"];
			$tamaño_audio = $_FILES["archivo_audio"]["size"];
			$destino = "";

			if($tipo_audio == "audio/mp3" || $tipo_audio == "audio/wav" || $tipo_audio == "audio/wma" || $tipo_audio == "audio/mpeg"){
				
				opendir($ruta);

				$destino = $ruta.$_FILES["archivo_audio"]["name"];

				$ruta_archivo = $_FILES["archivo_audio"]["name"];

				$ruta = copy($_FILES["archivo_audio"]["tmp_name"],$destino);

				$conexion = new PDO ("mysql:host=localhost; dbname=itms_capacitacion", "root", "");
				$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conexion -> exec("SET CHARACTER SET utf8");

				$sql = "SELECT * FROM audio";

				$resultado = $conexion -> prepare($sql);

				$resultado -> execute(array());

				$num_registros = $resultado -> rowCount();

				$resultado -> closeCursor();

				$sql2 = "SELECT * FROM audio";

				$resultado2 = $conexion -> prepare($sql2);
				
				$rruta = array();

				$resultado2 -> execute(array());
				
				while ($row = $resultado2 -> fetch(PDO::FETCH_ASSOC)) {

					$rruta[] = stripcslashes($row["ruta"]);
					$ttamaño = stripcslashes($row["tamaño"]);

				}

				if (in_array($destino, $rruta)) {

					include("../../alerts/modal_d_archivo.php");
				}else{

					$sql2 = "INSERT INTO audio (nombre_audio, ruta, tamaño) VALUES ('$nombre_audio', '$destino', '$tamaño_audio')";

					if(!$result2 = $conexion ->query($sql2)){
						die ('Error al insertar los datos [' .$conexion->error .']');
					}

					// include("../views/alerts/alerta_s_archivo.html");
					header("Location: ../../admin/views/archivos_audio.php");
				}

			}else{

				include("../../alerts/modal_d_audio.php");

			}
		}
	}

	$nuevo = new Audio();
	$nuevo -> subir_audio($_POST["nombre"]);
?>