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
		<title>Actualizar Perfil</title>
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
          <ul class="navbar-nav list-group-item-action b_bottom2 enlaces2">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                <div class="barra"></div>
                <span>Mi Perfil</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="actualizar_perfil">Actualizar perfil</a>
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

        class Datos{
          public function mostrar($doc_perfil){

            include("../../models/conexion.php");

            $cont = "0";
            $doc_perfil = $_SESSION['documento'];

            $sql = "SELECT * FROM usuarios WHERE documento = '$doc_perfil'";

            if (!$result = $db -> query($sql)) {
              die('Hay un error en la consulta [' .$db->error. ']');
            }

            while($row = $result -> fetch_assoc()){
              $ttipo_documento = stripcslashes($row['tipo_documento']);
              $ddocumento = stripcslashes($row['documento']);
              $nnombres = stripcslashes($row['nombres']);
              $aapellidos = stripcslashes($row['apellidos']);
              $ccorreo = stripcslashes($row['correo']);
              $cont = $cont + 1;
            }

            $nombres = null;
            $apellidos = null;
            $nombres = strtoupper($nombres);
            $apellidos = strtoupper($apellidos);

            if ($cont == "0") {
              include("../../alerts/modal_d_perfil.php");
            }

            if ($cont != "0") {
?>
            <div class="container div4 color2">

              <form action="../../admin/controllers/perfil.php" method="POST" name="form3">

                <div class="row b_bottom">
                  <div class="col-sm-12 encabezado">
                    Actualizar información del usuario 
                  </div>
                </div>
                <div id="alerta"></div>
                <div class="row espacio2">
                  <div class="col-sm-3 t_centro negrilla espacio2">
                    <label id="tdoc">Tipo de documento</label>
                  </div>
                  <div class="col-sm-3 t_centro">
                    <?php         
                      echo "<select class='form-control inputs' name='tipo_documento' id='tdoc'>";

                      $sql2 = "SELECT * FROM tipo_documento";

                        if(!$result2 = $db ->query($sql2)){
                          die ('Hay un error en la consulta [' .$db->error .']');
                        }

                        while($row2 = $result2->fetch_assoc()){
                          $iid_tipo_documento = stripcslashes($row2["id_tipo_documento"]);
                          $tttipo_documento = stripcslashes($row2["tipo_documento"]);

                          if($iid_tipo_documento==$ttipo_documento){
                            echo"<option value=$iid_tipo_documento SELECTED>$tttipo_documento</option>";
                          } 
                          // else{
                          //     echo"<option value=$iid_tipo_documento>$tttipo_documento</option>"; 
                          //   }
                        }
                        echo "</select>";
                    ?>
                  </div>
                  <div class="col-sm-2 t_centro negrilla espacio2">
                    Documento
                  </div>
                  <div class="col-sm-4 t_centro espacio2">
                    <?php echo $ddocumento ?>
                  </div>
                </div>

                <div class="row espacio2 negrilla">
                  <div class="col-sm-3 t_centro espacio2">
                    <label id="names">Nombres</label>
                  </div>
                  <div class="col-sm-3 t_centro">
                    <input type="text" id="names" class="form-control inputs" name="nombres" autocomplete="off" value="<?php echo $nnombres ?>">
                  </div>
                  <div class="col-sm-2 t_centro espacio2">
                    <label id="lastname">Apellidos</label>
                  </div>
                  <div class="col-sm-4 t_centro">
                    <input type="text" id="lastname" class="form-control inputs" name="apellidos" autocomplete="off" value="<?php echo $aapellidos ?>">
                  </div>
                </div>

                <div class="row espacio2">
                  <div class="col-sm-3 t_centro negrilla espacio2">
                    <label id="mail">Correo electrónico</label>
                  </div>
                  <div class="col-sm-9 t_centro">
                    <input type="text" id="mail" class="form-control inputs" name="correo" autocomplete="off" value="<?php echo $ccorreo ?>">
                  </div>
                </div>
                <br>
                <div class="row centro ">
                  <!-- <input type="submit" class="btn btn-sm btn-outline-dark" value="Actualizar"> -->
                  <button type="button" onclick="return validar()" class="btn btn-sm btn-outline-dark">
                    Actualizar
                  </button>
                </div>
                <br>
                <div class="row centro">
                  <a href="../../admin/views/home" class="links">Volver</a>
                </div>
                <br>
              </form>
            </div>
<?php
      }
    }
  }     
        $doc_perfil = $_SESSION["documento"];
        $nuevo = new Datos();
        $nuevo->mostrar($doc_perfil);
?>

      <script type="text/javascript">
        function actualizar() {

          var respuesta = confirm("Se actualizara la información del perfil.");

          if (respuesta == true) {

            return true;

          }else{

            return false;
          }
        }
      </script>

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