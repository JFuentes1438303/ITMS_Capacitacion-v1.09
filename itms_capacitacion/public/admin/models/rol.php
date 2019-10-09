<?php  
  session_start();
    if ($_SESSION["admin"] != "ADMINISTRADOR") {
      header("Location: ../../../index");
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="../../../vendor/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../../css/estilos.css">
		<link rel="stylesheet" href="../../../css/simple-sidebar.css">
		<link rel="shortcut icon" href="../../../files/img/ITMS2.ico">
		<title>Actualizar rol</title>
	</head>
	<body>
<div class="d-flex" id="wrapper">
<!-- Sidebar -->
<div id="sidebar-wrapper">

	<div class="">
		<a href="../../admin/views/home.php">
			<img src="../../../files/img/Logo ITMS.png" class="logo">
		</a>
	</div>

	<div class="list-group list-group-flush b_right">
		<ul class="navbar-nav list-group-item-action enlaces2 b_bottom2">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
				<div class="barra"></div>
				<span>Mi Perfil</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="actualizar_perfil">Actualizar perfil</a>
					<hr>
					<a class="dropdown-item" href="../../models/cerrar_sesion" style="padding-top: 0.1%">
					Cerrar sesión
					</a>
				</div>
			</li>
		</ul>

		<ul class="navbar-nav list-group-item-action enlaces2">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
				<div class="barra"></div>
				<span>Usuarios</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="reporte_usuarios">Reporte usuarios</a>
					<hr>
					<a class="dropdown-item" href="../../admin/views/rol" style="padding-top: 0.1%">
						Actualizar rol
					</a>
				</div>
			</li>
		</ul>

		<a href="../../admin/views/archivos_audio" class="list-group-item list-group-item-action enlaces">
			<div class="barra"></div>
			<span>Audios</span>
		</a>

		<a href="../../admin/views/archivos_video" class="list-group-item list-group-item-action enlaces">
			<div class="barra"></div>
			<span>Videos</span>
		</a>

		<a href="../../admin/views/archivos_multimedia" class="list-group-item list-group-item-action enlaces">
			<div class="barra"></div>
			<span>Multimedia</span> 
		</a>

		<a href="../../admin/views/archivos_documento" class="list-group-item list-group-item-action enlaces">
			<div class="barra"></div>
			<span>Documentos</span> 
		</a>

		<div class="row centro color3 b_bottom2 enlaces" style="width: 106.5%; height: 140px">
         	<div class="col-sm-6" style="padding-top: 8%; padding-left: 15%">
               	<a href="https://co.linkedin.com/company/itms-telemedicina-de-colombia">
                  	<i class="fab fa-linkedin fa-4x redes"></i>
           		</a>
             </div>
         	<div class="col-sm-6" style="padding-top: 8%; padding-left: 15%">
               	<a href="https://www.facebook.com/pages/category/Medical-Company/ITMS-137986102939589/">
                 	<i class="fab fa-facebook-square fa-4x redes"></i>
               	</a>
         	</div>
      	</div>

		<div class="t_centro color3 b_bottom" style="font-size: 11px; padding-top: 5%; padding-bottom: 5%; background: #f2f2f2">
			ITMS Capacitación (1) 593-1770<br>
			&copy; Todos los derechos reservados <br>
			2019
		</div>

		</div>
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
	<div id="page-content-wrapper">
		<nav class="navbar navegacion b_bottom">
			<button class="btn boton_menu" id="menu-toggle">
				<i class="fas fa-bars"></i>
			</button>

			<div class="sesion">
				<p class="">
				<?php 
					echo $_SESSION["admin"].": ". $_SESSION["nombres"]." ".$_SESSION["apellidos"];
				?>
				</p>
			</div>
		</nav>

<?php  

	class Rol{
		public function actualizar($doc_rol){

		$conexion = new PDO ("mysql:host=localhost; dbname=itms_capacitacion", "root", "");

		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$conexion -> exec("SET CHARACTER SET utf8");

		$_SESSION["doc_rol"] = $doc_rol;

		$sql2 = "SELECT * FROM usuarios WHERE documento = '$doc_rol'";

		$resultado2 = $conexion -> prepare($sql2);

		$resultado2 -> execute(array());

		$cont = 0;

        while($registro2 = $resultado2 -> fetch(PDO::FETCH_ASSOC)){
			$rrol = stripcslashes($registro2['rol']);
			$ddocumento = stripcslashes($registro2['documento']);
			$nnombres = stripcslashes($registro2['nombres']);
			$aapellidos = stripcslashes($registro2['apellidos']);
			$cont++;
		}

			if($cont == 0){

				include("../../alerts/modal_d_rol.php");
			}else{
?>
<div class="container div6 color2">
	<form action="../../admin/controllers/rol.php" method="POST">
	<div class="row encabezado b_bottom">
		<div class="col-sm-12">
			Actualizar rol
		</div>
	</div>
	<br>
	<div class="row t_centro" style="font-size: 18px; padding-left: 4%">
		<div class="col-sm-2 espacio2 negrilla">
			Rol
		</div>
		<div class="col-sm-4">
		<?php
			echo "<select id='rol' name='rol' class='form-control inputs'>"; 
				$sql4 = "SELECT * FROM rol";
				$resultado4 = $conexion -> prepare($sql4);
				$resultado4 -> execute(array());

				while($registro4 = $resultado4 -> fetch(PDO::FETCH_ASSOC)){
				$iid_rol = stripcslashes($registro4["id_rol"]);
				$rrrol = stripcslashes($registro4["rol"]);

					if($iid_rol==$rrol){
						echo"<option value=$iid_rol SELECTED>$rrrol</option>";
					}else{
						echo"<option value=$iid_rol>$rrrol</option>";
					} 
				}
			echo "</select>";
		?>
		</div>
		<div class="col-sm-3 espacio2 negrilla">
			Documento
		</div>
		<div class="col-sm-3">
			<?php echo $ddocumento ?>
		</div>
	</div>
	<br>
	<div class="row t_centro">
		<div class="col-sm-3 espacio2 negrilla" style="font-size: 18px">
			Nombres
		</div>
		<div class="col-sm-3 espacio2">
			<?php echo $nnombres ?>
				
			</div>
		<div class="col-sm-3 espacio2 negrilla" style="font-size: 18px">
			Apellidos
		</div>
		<div class="col-sm-3 espacio2">
			<?php echo $aapellidos ?>
		</div>
	</div>
	<br>
	<div class="row centro">
		<button type="submit" class="btn btn-sm btn-outline-dark">Actualizar rol</button>
	</div>
	<br>
	<div class="row centro">
		<a href="../../admin/views/home" class="links">Volver</a>
	</div>
	</form>
	<br>
<?php
			}	
		}
	}
	
	$nuevo = new Rol();
	$nuevo -> actualizar($_POST["doc_rol"]);

?>
	<script src="../../../vendor/js/bootstrap.bundle.min.js"></script>
	<script src="../../../vendor/jquery/jquery.min.js"></script>
	<script src="../../../vendor/js/validar3.js"></script>
	<script src="https:kit.fontawesome.com/2c36e9b7b1.js"></script>
	<script>
		$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
		});
	</script>
	</body>
</html>