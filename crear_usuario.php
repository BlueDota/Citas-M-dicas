<?php include "includes/header.php" ?>
<?php

if(isset($_POST["crearUsuario"])){

  //Obtener valores
  $N_historia = $_POST["NUM_HISTORIA"];
  $nacionalidad= $_POST["COD_NACIONALIDAD"];
  $cedula = $_POST["CED_PASAPORTE"];
  $nombre = ($_POST["NOMBRE_PACIENTE"]);
  $apellido = $_POST["APELLIDO_PACIENTE"];
  $fecha_nac = $_POST["FECHA_NACI"];
  $cedula = $_POST["CEDULA_PACIENTE"];
  $direccion = $_POST["DIRECCION_PACIENTE"];
  $correo = $_POST["CORREO_PACIENTE"];


  //Validar si está vacío
  if (empty($N_historia) || empty($nacionalidad) || empty($cedula) || empty($nombre)) {
    $error = "Error, algunos campos obligatorios están vacíos";      
  }else{
    //Si entra por aqui es porque se puede ingresar el nuevo registro
    $query = "INSERT INTO PACIENTE(NUM_HISTORIA,COD_NACIONALIDAD,CED_PASAPORTE,NOMBRE_PACIENTE,APELLIDO_PACIENTE,FECHA_NACI,CEDULA_PACIENTE,DIRECCION_PACIENTE,CORREO_PACIENTE)
    VALUES(:NUM_HISTORIA,:COD_NACIONALIDAD,:CED_PASAPORTE,:NOMBRE_PACIENTE,:APELLIDO_PACIENTE,:FECHA_NACI,:CEDULA_PACIENTE,:DIRECCION_PACIENTE,:CORREO_PACIENTE)";
    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":NUM_HISTORIA", $N_historia, PDO::PARAM_INT);
    $stmt->bindParam(":COD_NACIONALIDAD", $nacionalidad, PDO::PARAM_STR);
    $stmt->bindParam(":CED_PASAPORTE", $cedula, PDO::PARAM_STR);
    $stmt->bindParam(":NOMBRE_PACIENTE", $nombre, PDO::PARAM_STR);
    $stmt->bindParam(":APELLIDO_PACIENTE", $apellido , PDO::PARAM_INT);
    $stmt->bindParam(":FECHA_NACI", $fecha_nac, PDO::PARAM_INT);
    $stmt->bindParam(":CEDULA_PACIENTE", $cedula , PDO::PARAM_INT);
    $stmt->bindParam(":DIRECCION_PACIENTE", $direccion, PDO::PARAM_INT);
    $stmt->bindParam(":CORREO_PACIENTE", $correo, PDO::PARAM_INT);

    $resultado = $stmt->execute();

    if ($resultado) {
      $mensaje = "Registro de usuario creado correctamente";
    }else{
      $error = "Error, no se pudo crear el usuario";  
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



              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Crear un nuevo usuario</h3>
                  </div>                 
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <form role="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">            

                      <div class="mb-3">
                        <label for="NUM_HISTORIA" class="form-label">Numero_Historia:</label>
                        <input type="text" name="NUM_HISTORIA" class="form-control"  >
                      </div>

                      
                      <div class="mb-3">
                       <label for="COD_NACIONALIDAD" class="form-label">Nacionalidad:</label>
                        <select class="form-control" name="COD_NACIONALIDAD" aria-label="Default select example">                       
                        <option value="">Selecciona una opción</option>
                        <option value="arg005">Argentina</option>
                        <option value="bol007">Boliviar</option>
                        <option value="chi006">Chile</option>
                        <option value="col002">Colombia</option>
                        <option value="cub008">Cuba</option>
                        <option value="ecu001">Ecuador</option>
                        <option value="per003">Perú</option>
                        <option value="ven004">Venezuela</option>
                        </select>  
                    </div>  



                      <div class="mb-3">
                        <label for="CED_PASAPORTE" class="form-label">Cédula-Pasaporte:</label>
                        <input type="text" name="CED_PASAPORTE" class="form-control">
                      </div>

                       <div class="mb-3">
                        <label for="NOMBRE_PACIENTE" class="form-label">Nombre:</label>
                        <input type="text" name="NOMBRE_PACIENTE" class="form-control">
                      </div>   

                      <div class="mb-3">
                        <label for="APELLIDO_PACIENTE" class="form-label">Apellido:</label>
                        <input type="text" name="APELLIDO_PACIENTE" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="FECHA_NACI" class="form-label">Fecha de Nacimiento:</label>
                        <input type="text" name="FECHA_NACI" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="CEDULA_PACIENTE" class="form-label">CELULAR:</label>
                        <input type="text" name="CEDULA_PACIENTE" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="DIRECCION_PACIENTE" class="form-label">Direccion:</label>
                        <input type="text" name="DIRECCION_PACIENTE" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label for="CORREO_PACIENTE" class="form-label">Correo:</label>
                        <input type="text" name="CORREO_PACIENTE" class="form-control">
                      </div>

                      




                            <button type="submit" name="crearUsuario" class="btn btn-primary"><i class="fas fa-cog"></i> Crear Usuario</button>  

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
