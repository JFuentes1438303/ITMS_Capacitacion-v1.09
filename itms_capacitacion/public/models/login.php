<?php  

class Login{
	public function validar($documento, $password){

			session_start();

			include("conexion.php");
			$ppassword = "";
			$sql = "SELECT * FROM usuarios WHERE documento = '$documento'";

			if(!$result = $db ->query($sql)){
				die ('Ya existe un registro con ese documento [' .$db->error .']');
			}

			while ($row = $result -> fetch_assoc()) {

				$ddocumento = stripslashes($row["documento"]);
				$ppassword = stripslashes($row["password"]);
				$nnombres = stripslashes($row["nombres"]);
				$aapellidos = stripslashes($row["apellidos"]);
				$rrol = stripcslashes($row["rol"]);

				$_SESSION["nombres"] = $nnombres;
				$_SESSION["apellidos"] = $aapellidos;
 			}

		if (password_verify($password, $ppassword) && $documento == $ddocumento && $rrol == "1") {

			$_SESSION["documento"] = $ddocumento;
			$_SESSION["usuario"] = "USUARIO";
			header("Location: ../user/views/home_user");

		}else if(password_verify($password, $ppassword) && $documento == $ddocumento && $rrol == "2"){

			$_SESSION["documento"] = $ddocumento;
			$_SESSION["admin"] = "ADMINISTRADOR";
			header("Location: ../admin/views/home");
		}else{

			include("../alerts/modal_d_login.php");
		}
	}
}

	$nuevo = new Login();
	$nuevo -> validar($_POST["documento"], $_POST["password"]);

?>