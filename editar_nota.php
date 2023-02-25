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
  if(isset($_POST["editarNota"])){

    //Obtener valores
    $titulo = $_POST["titulo"];


    //Validar si está vacío
    if (empty($titulo)) {
      $error = "Error, algunos campos obligatorios están vacíos";      
    }else{
      //Si entra por aqui es porque se puede ingresar el nuevo registro
      $query = "UPDATE FACTURA SET TOTAL_PAGAR=:TOTAL_PAGAR WHERE NUM_FACTURA=:NUM_FACTURA";     

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":TOTAL_PAGAR", $titulo, PDO::PARAM_STR);   
      $stmt->bindParam(":NUM_FACTURA", $idNota, PDO::PARAM_INT);

      $resultado = $stmt->execute();

      if ($resultado) {
        $mensaje = "Registro de nota editado correctamente";
      }else{
        $error = "Error, no se pudo editar la nota";  
      }
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


 <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                      <div class="mb-3">
                        <label for="titulo" class="form-label">Total a pagar:</label>
                        <input type="text"  name="titulo" class="form-control" value="<?php if($nota) echo $nota->TOTAL_PAGAR; ?>">
                        
                      </div>

    

                            <button type="submit" name="editarNota" class="btn btn-primary"><i class="fas fa-cog"></i> Editar </button>  

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
