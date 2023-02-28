<?php include "includes/header.php" ?>

<?php

//Validar si recibimos el id, se envía por GET
if (isset($_GET["id"])) {
  $idNota = $_GET['id'];
}

//Obtener los datos de la nota por su id
$query = "SELECT * FROM FACTURA WHERE ID_CITA=:id";
$stmt = $conn->prepare($query);
//Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
//Llamado por referencia
$stmt->bindParam(":id", $idNota, PDO::PARAM_INT);
$stmt->execute();

$nota = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST["crearUsuario"])){

  $NUM_FACTURA = $_POST["NUM_FACTURA"];
  $ID_CITA = $_POST["ID_CITA"];
  $FECHA_PAGO = $_POST["FECHA_PAGO"];
  $TOTAL_PAGAR= $_POST["TOTAL_PAGAR"];

  //Validar si está vacío
  if (empty($NUM_FACTURA) || empty($ID_CITA) || empty($FECHA_PAGO) || empty($TOTAL_PAGAR)) {
    $error = "Error, algunos campos obligatorios están vacíos";      
  }else{
    //Si entra por aqui es porque se puede ingresar el nuevo registro
    $query = "INSERT INTO FACTURA(NUM_FACTURA,ID_CITA,FECHA_PAGO,TOTAL_PAGAR)
    VALUES(:NUM_FACTURA,:ID_CITA,:FECHA_PAGO,:TOTAL_PAGAR)";
    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":NUM_FACTURA", $NUM_FACTURA, PDO::PARAM_STR);
    $stmt->bindParam(":ID_CITA", $ID_CITA, PDO::PARAM_STR);
    $stmt->bindParam(":FECHA_PAGO", $FECHA_PAGO, PDO::PARAM_STR);
    $stmt->bindParam(":TOTAL_PAGAR", $TOTAL_PAGAR, PDO::PARAM_INT);

    $resultado = $stmt->execute();

    if ($resultado) {
      $mensaje = "Registro de usuario creado correctamente";
    

    }else{
      $error = "Error, no se pudo agendar la cita";  
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
        
        
<?php  

//Generador de numero de factura 
$query = "SELECT TOP 1(NUM_FACTURA) AS ULTIMO
from FACTURA
ORDER BY NUM_FACTURA DESC";
$stmt = $conn->query($query);
$Nidcita = $stmt->fetchAll(PDO::FETCH_OBJ);

//var_dump($registros);

?>
             <?php foreach($Nidcita as $fila) : ?>

                      <?php 

                      $nuevoValor =$fila->ULTIMO+1;
                           ?>

                  <?php endforeach; ?>
 
            <!-- /.card-body -->

            <div class="card-header">               
              <div class="row">
                <div class="col-md-9">
                  <h3 class="card-title">Agendar una cita médica</h3>
                </div>                 
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            


                <div class="mb-3">
                      <label for="NUM_FACTURA" class="form-label">Número de Factura:</label>
                      <input type="text" readonly  name="NUM_FACTURA" class="form-control" value="<?php  echo $nuevoValor; ?>">
                    </div>

               <div class="mb-3">
                      <label for="ID_CITA" class="form-label">Id cita:</label>
                      <input type="text"   name="ID_CITA" class="form-control" value="<?php if($nota) echo $nota->ID_CITA; ?>">
                </div>
                    

                    <div class="mb-3">
                      <label for="FECHA_PAGO" class="form-label">Fecha de pago:</label>
                      
                      <input type="text" name="FECHA_PAGO" class="form-control">
                    </div>

                     <div class="mb-3">
                      <label for="TOTAL_PAGAR" class="form-label">Total a pagar:</label>
                      <input type="text" name="TOTAL_PAGAR" class="form-control">
                    </div>   


                          <button  type="submit"  name="crearUsuario" class="btn btn-primary"><i class="fas fa-cog"></i> Generar Factura</button> 
                         
                        
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
