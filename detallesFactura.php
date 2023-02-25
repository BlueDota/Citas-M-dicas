<?php include "includes/header.php" ?>


<?php
  //Validar si recibimos el id, se envía por GET
  if (isset($_GET["id"])) {
    $idNota = $_GET['id'];
  }

?>
<?php  

  //Mostrar registros
  $query = "SELECT NOMBRE_PACIENTE,APELLIDO_PACIENTE, CEDULA_PACIENTE,CORREO_PACIENTE,DESCRIPCION,NOMBRE_DOCTOR, NUM_FACTURA,FECHA_PAGO,TOTAL_PAGAR FROM FACTURA F INNER JOIN AGENDAMIENTO A 
  ON 
  F.ID_CITA = A.ID_CITA INNER JOIN PACIENTE P 
  ON A.NUM_HISTORIA = P.NUM_HISTORIA INNER JOIN DOCTOR D 
  ON A.ID_DOCTOR = D.ID_DOCTOR INNER JOIN ESPECIALIDAD E
  ON D.ID_ESPECIALIDAD = E.ID_ESPECIALIDAD WHERE NUM_FACTURA= $idNota";
  
  $stmt = $conn->query($query);
  $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

  //var_dump($registros);

?>


                   <?php foreach($usuarios as $fila) : ?>
                   <tr>
                          <?php  $fila->NOMBRE_PACIENTE; ?>
                          <?php  $fila->APELLIDO_PACIENTE; ?>
                          <?php  $fila->CEDULA_PACIENTE; ?>
                          <?php  $fila->CORREO_PACIENTE; ?>
                          <?php  $fila->DESCRIPCION; ?>
                          <?php  $fila->NOMBRE_DOCTOR; ?>
                          <?php  $fila->NUM_FACTURA; ?>
                          <?php  $fila->FECHA_PAGO; ?>
                          <?php  $fila->TOTAL_PAGAR; ?>
                    </tr> 
                    <?php endforeach; ?>

         <div class="mb-3">
             <label for="ID_CITA" class="form-label">Nombre del paciente:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->NOMBRE_PACIENTE; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Apellido del paciente:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php echo $fila->APELLIDO_PACIENTE; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Número telefónico:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->CEDULA_PACIENTE; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Correo del paciente:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->CORREO_PACIENTE;?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Especialidad elegida:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->DESCRIPCION; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Nombre del Doctor:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php echo $fila->NOMBRE_DOCTOR; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Factura N°:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->NUM_FACTURA; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Fecha de pago:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->FECHA_PAGO; ?>">
        </div>
        <div class="mb-3">
             <label for="ID_CITA" class="form-label">Total a pagar:</label>
            <input type="text" readonly  name="ID_CITA" class="form-control" value="<?php  echo $fila->TOTAL_PAGAR; ?>">
        </div>

        <a href="lista_notas.php?id=<?php echo $fila->NUM_FACTURA; ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> 
                                
        <i class="fas fa-trash-alt"></i> Regresar</a>  

<?php include "includes/footer.php" ?>


















