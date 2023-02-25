<?php include "includes/header.php" ?>

<?php  

  //Mostrar registros
  $query = "SELECT NOMBRE_PACIENTE, APELLIDO_PACIENTE,CED_PASAPORTE, ID_CITA,DESCRIPCION, FECHA_AGENDAMIENTO, HORA_INICIO, HORA_FINAL from PACIENTE P
  INNER JOIN AGENDAMIENTO A 
  ON P.NUM_HISTORIA = A.NUM_HISTORIA
  INNER JOIN DOCTOR D 
  ON A.ID_DOCTOR = D.ID_DOCTOR
  INNER JOIN ESPECIALIDAD E
  ON D.ID_ESPECIALIDAD = E.ID_ESPECIALIDAD";
  $stmt = $conn->query($query);
  $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

  //var_dump($registros);

?>

              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Lista de todos los registros usuarios</h3>
                  </div>

              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tblUsuarios" class="table table-bordered table-striped">
                  
                <thead>
                  <tr>

                  <th>ID cita</th>    
                  <th>Nombre del paciente</th> 
                  <th>Apellido del paciente</th> 
                  <th>Cédula o Pasaporte</th> 
                                
                  <th>Apellido</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Hora de Inicio</th>
                  <th>Hora de finalización</th>
                  <th>Opciones</th>
                      
                  </tr>
                </thead>

                  <tbody>

                <?php foreach($usuarios as $fila) : ?>
                   <tr>
                          <td><?php echo $fila->ID_CITA; ?></td>
                          <td><?php echo $fila->NOMBRE_PACIENTE; ?></td>
                          <td><?php echo $fila->APELLIDO_PACIENTE; ?></td>
                          <td><?php echo $fila->CED_PASAPORTE; ?></td>
                         
                          <td><?php echo $fila->DESCRIPCION; ?></td>
                          <td><?php echo $fila->FECHA_AGENDAMIENTO; ?></td>
                          <td><?php echo $fila->HORA_INICIO; ?></td>
                          <td><?php echo $fila->HORA_FINAL; ?></td>

                          <td>
                                <a href="facturaGen.php?id=<?php echo $fila->ID_CITA; ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-fill"></i> 
                                
                                <i class="fas fa-edit"></i> Generar Factura</a>
                                &nbsp;
                                  
                          </td>  

                    </tr> 
                    <?php endforeach; ?>
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->

<?php include "includes/footer.php" ?>

<!-- page script -->
<script>
  $(function () {   
    $('#tblUsuarios').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });  

    

    //Timepicker
    $('#timepicker').datetimepicker({
        format: 'HH:mm',        
        enabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,25,26,27,28],
        stepping: 30
    })
  
  });
</script>
            