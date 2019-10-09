<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/estilos.css">
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/js/bootstrap.min.js"></script>
  </head>

  <body>
    
    <div class="container">
    <!-- The Modal -->
      <div class="modal" id="myModal" style="margin-left: -5.5%; margin-top: 5%">
        <div class="modal-dialog">
          <div class="modal-content d_modal">

            <!-- Modal Header -->
            <div class="modal-header centro encabezado b_bottom">
            <h3 class="modal-title">Error !!!</h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body t_centro color2">
              <h5>El número de documento ingresado no esta registrado en la DB.</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer centro color2">
              <a href="../../../public/admin/views/rol.php" class="btn btn-sm btn-outline-dark">Volver</a>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script>
      $('#myModal').modal({backdrop: 'static', keyboard: false})

      $(document).ready(function(){
      // Show the Modal on load
      $("#myModal").modal("show");
      });
    </script>
  </body>
</html>