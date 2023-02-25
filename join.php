<?php include "includes/header.php" ?>

<?php  

  //Mostrar registros
 
  $query = "SELECT NOMBRE_DOCTOR,APELLIDO_DOCTOR,DESCRIPCION, CEDULA_DOCTOR, DIAS, JORNADA, HORAS, VALOR from DOCTOR D 
  inner join HORARIO H 
  on D.ID_DOCTOR = H.ID_DOCTOR
  inner join ESPECIALIDAD E
  on D.ID_ESPECIALIDAD = E.ID_ESPECIALIDAD";
  $stmt = $conn->query($query);
  $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

  //var_dump($registros);

?>

              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Lista de todos los registros usuarios</h3>
                  </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tblUsuarios" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Nombre</th> 
                  <th>Apellido</th> 
                  <th>Especialidad</th> 
                  <th>Días</th> 
                  <th>Jornada</th>  
                  <th>Horas</th>  
                  <th>Costo</th>                   
        
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($usuarios as $fila) : ?>
                   <tr>
                          <td><?php echo $fila->NOMBRE_DOCTOR; ?></td>
                          <td><?php echo $fila->APELLIDO_DOCTOR; ?></td>
                          <td><?php echo $fila->DESCRIPCION; ?></td>
                          <td><?php echo $fila->DIAS; ?></td>
                          <td><?php echo $fila->JORNADA; ?></td>
                          <td><?php echo $fila->HORAS; ?></td>
                          <td><?php echo "$ ".$fila->VALOR; ?></td>

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
            