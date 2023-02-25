<?php include "includes/header.php" ?>

<?php

//Validar si recibimos el id, se envía por GET
if (isset($_GET["id"])) {
  $idNota = $_GET['id'];
}

//Obtener los datos de la nota por su id
$query = "SELECT * FROM AGENDAMIENTO WHERE NUM_HISTORIA=:id";
$stmt = $conn->prepare($query);
//Debemos pasar a bindParam las variables, no podemos pasar el dato directamente
//Llamado por referencia
$stmt->bindParam(":id", $idNota, PDO::PARAM_INT);
$stmt->execute();

$nota = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST["crearUsuario"])){

  $ID_CITA = $_POST["ID_CITA"];
  $Especialidad = $_POST["ID_DOCTOR"];
  $Historia = $_POST["NUM_HISTORIA"];
  $fecha_agendamiento= $_POST["FECHA_AGENDAMIENTO"];
  $fecha_inicio= $_POST["HORA_INICIO"];
  $Fecha_fin = ($_POST["HORA_FINAL"]);
  
  //Validar si está vacío
  if (empty($ID_CITA) || empty($Especialidad) || empty($fecha_agendamiento) || empty($Fecha_fin)) {
    $error = "Error, algunos campos obligatorios están vacíos";      
  }else{
    //Si entra por aqui es porque se puede ingresar el nuevo registro
    $query = "INSERT INTO AGENDAMIENTO(ID_CITA,ID_DOCTOR,NUM_HISTORIA,FECHA_AGENDAMIENTO,HORA_INICIO,HORA_FINAL)
    VALUES(:ID_CITA,:ID_DOCTOR,:NUM_HISTORIA,:FECHA_AGENDAMIENTO,:HORA_INICIO,:HORA_FINAL)";
    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":ID_CITA", $ID_CITA, PDO::PARAM_STR);
    $stmt->bindParam(":ID_DOCTOR", $Especialidad, PDO::PARAM_STR);
    $stmt->bindParam(":NUM_HISTORIA", $Historia, PDO::PARAM_STR);
    $stmt->bindParam(":FECHA_AGENDAMIENTO", $fecha_agendamiento, PDO::PARAM_INT);
    $stmt->bindParam(":HORA_INICIO", $fecha_inicio, PDO::PARAM_INT);
    $stmt->bindParam(":HORA_FINAL", $Fecha_fin , PDO::PARAM_INT);
 

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

//Mostrar registros
$query = "SELECT TOP 1(RIGHT(ID_CITA,2)) AS ULTIMO
from AGENDAMIENTO
ORDER BY ID_CITA DESC";
$stmt = $conn->query($query);
$Nidcita = $stmt->fetchAll(PDO::FETCH_OBJ);

//var_dump($registros);

?>

             <?php foreach($Nidcita as $fila) : ?>

                      <?php 

                      $nuevoValor ="C0".$fila->ULTIMO+1;
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
                      <label for="ID_CITA" class="form-label">Id de la cita:</label>
                      <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $nuevoValor; ?>">
                    </div>

               <div class="mb-3">
                      <label for="NUM_HISTORIA" class="form-label">Numero de Historia:</label>
                      <input type="text"   name="NUM_HISTORIA" class="form-control" value="<?php if($nota) echo $nota->NUM_HISTORIA; ?>">
                </div>
                    
                    <div class="mb-3">
                     <label for="ID_DOCTOR" class="form-label">Seleciona la especialidad:</label>
                      <select class="form-control" name="ID_DOCTOR" aria-label="Default select example">                       
                      <option value="">Selecciona una opción</option>
                      <option value="D001">Medicina General</option>
                      <option value="D002">Psicología</option>
                      <option value="D003">Traumatología</option>
                      <option value="D004">Podología</option>
                      <option value="D005">Odontología</option>
                      <option value="D006">Odontología</option>
                      <option value="D007">Cardiología</option>
                      <option value="D008">Fisioterapia</option>
                      </select>  
                  </div>  

            
                    <div class="mb-3">
                      <label for="FECHA_AGENDAMIENTO" class="form-label">Fecha de agendamiento:</label>
                      
                      <input type="text" name="FECHA_AGENDAMIENTO" class="form-control">
                    </div>

                     <div class="mb-3">
                      <label for="HORA_INICIO" class="form-label">Hora de Inicio:</label>
                      <input type="text" name="HORA_INICIO" class="form-control">
                    </div>   

                    <div class="mb-3">
                      <label for="HORA_FINAL" class="form-label">Hora final:</label>
                      <input type="text" name="HORA_FINAL" class="form-control">
                    </div>

                          <button  type="submit"  name="crearUsuario" class="btn btn-primary"><i class="fas fa-cog"></i> Agendar Cita</button> 
                         
                        
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

 