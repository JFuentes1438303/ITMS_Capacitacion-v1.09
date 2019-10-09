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
		<title>Reporte Usuarios</title>
	</head>
	<body>
<div class="d-flex toggled" id="wrapper">
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

	class Reporte{
		public function listar(){

		$conexion = new PDO ("mysql:host=localhost; dbname=itms_capacitacion", "root", "");

		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$conexion -> exec("SET CHARACTER SET utf8");

		$por_pagina = "4";
		$pagina_inicial = 1;

    		if(isset($_GET["pagina"])){

				if ($_GET["pagina"] == "1") {
					
				}else{

					$pagina_inicial = $_GET["pagina"];
				}

			}else{

				$pagina_inicial = "1";
			}

			$inicio_registro = ($pagina_inicial - 1) * $por_pagina;

    		$sql = "SELECT * FROM usuarios";

            $resultado = $conexion -> prepare($sql);

			$resultado -> execute(array());

			$num_registros = $resultado -> rowCount();

			$total_paginas = ceil($num_registros/$por_pagina);

			$resultado -> closeCursor();

			
?>	
			<div class="container-fluid div5 color2">
				<div class="row encabezado">
					<div class="col-sm-12">
						Reporte de usuarios
					</div>
				</div>
				<div class="row negrilla t_centro espacio2" style="font-size: 18px">
					<div class="col-sm-2">
						Tipo documento
					</div>
					<div class="col-sm-1">
						Documento
					</div>
					<div class="col-sm-2">
						Rol
					</div>
					<div class="col-sm-2">
						Nombres
					</div>
					<div class="col-sm-2">
						Apellidos
					</div>
					<div class="col-sm-3">
						Correo
					</div>
				</div>
<?php
			$sql2 = "SELECT * FROM usuarios ORDER BY rol DESC LIMIT $inicio_registro, $por_pagina";

			$resultado2 = $conexion -> prepare($sql2);

			$resultado2 -> execute(array());

            while($registro2 = $resultado2 -> fetch(PDO::FETCH_ASSOC)){
				$ttipo_documento = stripcslashes($registro2['tipo_documento']);
				$rrol = stripcslashes($registro2['rol']);
				$ddocumento = stripcslashes($registro2['documento']);
				$nnombres = stripcslashes($registro2['nombres']);
				$aapellidos = stripcslashes($registro2['apellidos']);
				$ccorreo = stripcslashes($registro2['correo']);
?>	

			<div class="row t_centro espacio2" style="font-size: 14px">
				<div class="col-sm-2">
				<?php 
					$sql3 = "SELECT * FROM tipo_documento";

					$resultado3 = $conexion -> prepare($sql3);

					$resultado3 -> execute(array());

					while($registro3 = $resultado3 -> fetch(PDO::FETCH_ASSOC)){
						$iid_tipo_documento = stripcslashes($registro3["id_tipo_documento"]);
						$tttipo_documento = stripcslashes($registro3["tipo_documento"]);

						if($iid_tipo_documento==$ttipo_documento){
							echo"<option value=$iid_tipo_documento>$tttipo_documento</option>";
						} 
					}
				?>
				</div>
				<div class="col-sm-1"><?php echo $ddocumento ?></div>
				<div class="col-sm-2" style="padding-left: ">
				<?php 
					$sql4 = "SELECT * FROM rol";

					$resultado4 = $conexion -> prepare($sql4);

					$resultado4 -> execute(array());

					while($registro4 = $resultado4 -> fetch(PDO::FETCH_ASSOC)){
						$iid_rol = stripcslashes($registro4["id_rol"]);
						$rrrol = stripcslashes($registro4["rol"]);

						if($iid_rol==$rrol){
							echo"<option value=$iid_rol>$rrrol</option>";
						} 
					}
				?>
				</div>
				<div class="col-sm-2"><?php echo $nnombres ?></div>
				<div class="col-sm-2"><?php echo $aapellidos ?></div>
				<div class="col-sm-3"><?php echo $ccorreo ?></div>
			</div>

<?php 
			}
?>	
<br>
<!-- paginacion -->		
<div class="row centro">
	<div class="col-sm-4 t_centro links2">
		<?php
			echo "Total de registros: $num_registros";
		?>
	</div>
	<div class="col-sm-4 t_centro">
	<?php  

		$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : '1';
	
		echo "<div class='row centro'>";
			echo "<ul class='pagination pag'>";
	
			if ($pagina_actual != 1) {
	
				echo "<li><a class='btn btn-sm page-link flecha' href='reporte_usuarios.php?pagina=".($pagina_actual-1)."'>";
					echo "<i class='fas fa-chevron-left'></i></i>";
				echo "</a>";
			}else{
				echo "<li><a class='btn btn-sm page-link b_disabled' disabled>";
					echo "<i class='fas fa-chevron-left'></i></i>";
				echo "</a>";
			}
			
			echo "<li class='page-item'>";
				
			for ($i=1; $i <= $total_paginas; $i++) { 
				if($pagina_actual == $i){
					echo "<li><a class='btn btn-sm page-link pagina active' href='reporte_usuarios.php?pagina=".$i."'>".$i."</a>";
				}else{
					echo "<li><a class='btn btn-sm page-link pagina' href='reporte_usuarios.php?pagina=".$i."'>".$i."</a>";
				}
			}

			if ($pagina_actual != $total_paginas) {
				echo "<li><a class='btn btn-sm page-link flecha' href='reporte_usuarios.php?pagina=".($pagina_actual+1)." '>";
					echo "<i class='fas fa-chevron-right'></i></i>";
				echo "</a>";
			}else{
				echo "<li><a class='btn btn-sm page-link b_disabled' disabled>";
					echo "<i class='fas fa-chevron-right'></i>";
				echo "</a>";
			}
			echo "</ul>";
			echo "</div>";
	?>
	</div>
	<div class="col-sm-4 t_centro links2">
		<a href="../../admin/views/home" class="links">Volver</a>
	</div>
</div>
<?php

		}
	}

	$nuevo = new Reporte();
	$nuevo -> listar();

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