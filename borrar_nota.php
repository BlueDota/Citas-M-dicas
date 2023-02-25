<?php include "includes/header.php" ?>
<?php
  //Validar si recibimos el id, se envía por GET
  if (isset($_GET["id"])) {
    $idNota = $_GET['id'];
  }

  //Obtener los datos de la nota por su id
  $query = "SELECT * FROM FACTURA WHERE NUM_FACTURA=:id";
  $stmt = $conn->prepare($query);

  //Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
  //Llamado por referencia
  $stmt->bindParam(":id", $idNota, PDO::PARAM_INT);
  $stmt->execute();

  $nota = $stmt->fetch(PDO::FETCH_OBJ);

  //Actualización de la nota
  if(isset($_POST["borrarNota"])){

   //Si entra por aqui es porque se puede borrar el registro
   $query = "DELETE FACTURA WHERE NUM_FACTURA=:idnota";     

   $stmt = $conn->prepare($query);        
   $stmt->bindParam(":idnota", $idNota, PDO::PARAM_INT);

   $resultado = $stmt->execute();

   if ($resultado) {
     $mensaje = "Registro de nota borrado correctamente";
   }else{
     $error = "Error, no se pudo borrar la nota";  
   }

    
  }

?>

<div class="row">
    <div class="col-sm-12">
            <?php if(isset($mensaje)) : ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><?php echo $mensaje; ?></strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          <?php endif; ?>      
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
            <?php if(isset($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><?php echo $error; ?></strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          <?php endif; ?>      
    </div>
</div>



              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Información de la factura</h3>
                  </div>                 
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                  <div class="mb-3">
                        <label for="titulo" class="form-label">Número de Factura:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php if($nota) echo $nota->NUM_FACTURA; ?>" readonly>
                      </div>

                      <div class="mb-3">
                        <label for="descripcion" class="form-label">ID de la cita:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php if($nota) echo $nota->ID_CITA; ?>" readonly>
                      </div>

                      <div class="mb-3">
                        <label for="descripcion" class="form-label">Fecha de pago:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php if($nota) echo $nota->FECHA_PAGO; ?>" readonly>
                      </div>

                      <div class="mb-3">
                        <label for="descripcion" class="form-label">Total a pagar:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php if($nota) echo $nota->TOTAL_PAGAR; ?>" readonly>
                      </div>

                      </div>      

                            <button type="submit" name="borrarNota" class="btn btn-primary"><i class="fas fa-cog"></i> Eliminar factura</button>  

                        </div>
                      </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->


<?php include "includes/footer.php" ?>

<!-- page script -->
<script>
  $(function () {   
    $('#tblRegistros').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    }); 
  });
</script>
