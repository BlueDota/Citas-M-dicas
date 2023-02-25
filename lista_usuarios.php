<?php include "includes/header.php" ?>

<?php  

  //Mostrar registros
  $query = " SELECT NUM_HISTORIA,NOM_NACIONALIDAD,CED_PASAPORTE,NOMBRE_PACIENTE,APELLIDO_PACIENTE,FECHA_NACI,CEDULA_PACIENTE,DIRECCION_PACIENTE 
  FROM PACIENTE P INNER JOIN 
  NACIONALIDAD N 
  ON P.COD_NACIONALIDAD = N.COD_NACIONALIDAD";

  $stmt = $conn->query($query);
  $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

  //var_dump($registros);

?>
              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h3 class="card-title">Usuarios Registrados</h3>
                  </div>
                  <div class="col-md-3">
                      <a href="crear_usuario.php" class="btn btn-primary btn-xl pull-right w-100">
                        <i class="fa fa-plus"></i>  Ingresar nuevo usuario</a>                  
                 </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tblUsuarios" class="table table-bordered table-striped">
                  
                <thead>
                  <tr>

                  <th>Número de Historia</th> 
                  <th>Nacionalidad</th> 
                  <th>Cédula o Pasaporte</th> 
                  <th>Nombre</th>                  
                  <th>Apellido</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Número Telefónico</th>       
                  <th>Dirección</th>
                  <th>Opciones</th>
                                               
                  </tr>
                </thead>

                  <tbody>

                <?php foreach($usuarios as $fila) : ?>
                   <tr>
                          <td><?php echo $fila->NUM_HISTORIA; ?></td>
                          <td><?php echo $fila->NOM_NACIONALIDAD; ?></td>
                          <td><?php echo $fila->CED_PASAPORTE; ?></td>
                          <td><?php echo $fila->NOMBRE_PACIENTE; ?></td>
                          <td><?php echo $fila->APELLIDO_PACIENTE; ?></td>
                          <td><?php echo $fila->FECHA_NACI; ?></td>
                          <td><?php echo $fila->CEDULA_PACIENTE; ?></td>
                          <td><?php echo $fila->DIRECCION_PACIENTE; ?></td>
                          <td>
                                <a href="agendamiento.php?id=<?php echo $fila->NUM_HISTORIA; ?>" class="btn btn-success">
                                <i class="bi bi-pencil-fill"></i> 
                                
                                <i class="fas fa-edit"></i> Agendar Cita</a>
                                
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
            