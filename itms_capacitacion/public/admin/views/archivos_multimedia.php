<?php  
  session_start();
    if ($_SESSION["admin"] != "ADMINISTRADOR") {
      header("Location: ../../../index");
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="../../../vendor/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../../css/estilos.css">
		<link rel="stylesheet" href="../../../css/simple-sidebar.css">
		<link rel="shortcut icon" href="../../../files/img/ITMS2.ico">
		<title>Multimedia</title>
	</head>


	<body>
    <div class="d-flex toggled" id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">

        <div class="">
            <a href="home.php">
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
                <a class="dropdown-item" href="../../admin/models/actualizar_perfil">Actualizar perfil</a>
                <hr>
                <a class="dropdown-item" href="../../models/cerrar_sesion" style="padding-top: 0.1%">Cerrar sesión</a>
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
                <a class="dropdown-item" href="../../admin/controllers/reporte_usuarios">   
                  Reporte de usuarios
                </a>
                <hr>
                <a class="dropdown-item" href="../../admin/views/rol" style="padding-top: 0.1%">
                  Actualizar rol
                </a>
              </div>
            </li>
          </ul>

          <a href="archivos_audio" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Audios</span>
          </a>

          <a href="archivos_video" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Videos</span>
          </a>

          <a href="archivos_multimedia" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Multimedia</span> 
          </a>

          <a href="archivos_documento" class="list-group-item list-group-item-action enlaces">
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

      <div class="container div color2"> 
        <?php
          include("../../admin/views/multimedia.php");
          include("../../admin/models/archivos_multimedia.php");  
        ?>
      </div>
		

    		<script src="../../../vendor/js/bootstrap.bundle.min.js"></script>
    		<script src="../../../vendor/jquery/jquery.js"></script>
      	<script src="https:kit.fontawesome.com/2c36e9b7b1.js"></script>


		 <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      </script>
	</body>
</html>