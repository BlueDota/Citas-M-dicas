

    <?php
    
            $host = 'localhost';
            $bdname = 'Citas3';
            $username = 'Ivancho';
            $password = '12345678';
            $puerto = '1433';
    
            try {
    
                $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$bdname",$username,$password);
               // echo "Se ha establecido conexión con  la base de datos";
            }catch (PDOException $exp){
                echo "No se pudo conectar a la base de datos: $bdname,error: $exp";
            }
    
      return $conn;
  
    ?>
    