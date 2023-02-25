<?php include "includes/header.php" ?>

<?php  

  //Mostrar registros
  $query = "SELECT * FROM FACTURA";
  $stmt = $conn->query($query);
  $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

  //var_dump($registros);

?>


              <div class="card-header">               
                <div class="row">
                  <div class="col-md-9">
                    <h1 class="card-title">Lista de Facturas</h1>
                  </div>
                  
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tblRegistros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N factura</th>
                    <th>ID de la cita</th>
                    <th>Fecha de pago</th>               
                    <th>Total a pagar </th>  
                    <th>Opciones </th>                
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($registros as $fila) : ?>
                      <tr>
                          <td><?php echo $fila->NUM_FACTURA; ?></td>
                          <td><?php echo $fila->ID_CITA; ?></td>
                          <td><?php echo $fila->FECHA_PAGO; ?></td>
                          <td><?php echo "$ ".$fila->TOTAL_PAGAR; ?></td> 

                          <td>
                                <a href="editar_nota.php?id=<?php echo $fila->NUM_FACTURA; ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-fill">
                    
                                </i> <i class="fas fa-edit"></i> Editar</a>
                                &nbsp;
                                
                                <a href="borrar_nota.php?id=<?php echo $fila->NUM_FACTURA; ?>" class="btn btn-danger"><i class="bi bi-pencil-fill"></i> 
                                
                                <i class="fas fa-trash-alt"></i> Borrar</a>    
                                
                                
                                <a href="detallesFactura.php?id=<?php echo $fila->NUM_FACTURA; ?>" class="btn  btn-primary">
                                <i class="bi bi-file-plus">

                                </i> <i class="fas fa-plus-circle"></i> Más Información</a>
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
