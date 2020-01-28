<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="imagenes/generales/ventas.png">

  <?php  include 'header.php'?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"/>

    <!-- Bootstrap CSS -->

    <title>Punto de venta</title>
  
  </head>
    <body>
        <form action="modificarcliente.php" method="POST" enctype="multipart/form-data">
        <div class="container magia">
        <?php
          if(isset($_POST['agregar']))
          {
            include('dbconexion.php');
            $nombre = $_POST['fullname'];
            $alias = $_POST['alias'];
            $direccion = $_POST['coordenadas'];
            $idCliente = $_POST['idCliente'];
            if(isset($_POST['direccion']) && !empty($_POST['direccion']))
            { 
                $direccion = $_POST['direccion'];
                $prepAddr = str_replace(str_split(',:;- '),'+',$direccion);
                $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&key=AIzaSyDvWYtM3yaNdJ6it_cguhYiBxHk2-Eqf3g');
               
                $output= json_decode($geocode);
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                $direccion = "$latitude,$longitude";
            }
            
            $zona = $_POST['zona'];
            $email = $_POST['email'];
            $ruta= './clientes/'.$alias.'.jpg'; 
            $foto=$alias.'.jpg';	
            if (isset($_FILES['UploadedFile']['name']) && !empty($_FILES['UploadedFile']['name']))
            {
              if(move_uploaded_file($_FILES['UploadedFile']['tmp_name'],$ruta))
              {
                $foto = $alias.'.jpg';
              }
              
            }	  
        
            /*else 
            {
              idCliente
              codigoCliente
              descripcionCliente
              zonaCliente
              ubicacionCliente
              fotoCliente
              correoCliente
              $file = './vendedores/generico.jpg';
              $newfile = './vendedores/'.$alias.'.jpg';;
              copy($file, $newfile);
            }*/
            $sql = "UPDATE clientes SET descripcionCliente = '$nombre', zonaCliente = '$zona',
            ubicacionCliente = '$direccion', fotoCliente = '$foto', correoCliente = '$email'
            WHERE idCliente = '$idCliente'";
            $result=$conn->query($sql);
            if ($result === TRUE) {
              echo '<div class="row">
                    <div class="col-12-md">
                      <div class="alert alert-success alert-dismissible  show" role="alert">
                        <strong>Modificacion Exitosa</strong> El cliente ha sido modificado exitosamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
              </div>';
            } else {
              echo '<div class="row">
                        <div class="col-12-md">
                          <div class="alert alert-warning alert-dismissible  show" role="alert">
                            <strong>Modificacion Fallida</strong> El cliente no ha sido modificado vuelva a intentarlo.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                  </div>';
            }
          }
          $datosCliente="";
          if(isset($_POST['buscar']) || isset($_GET['idCliente']))
          {
            include('dbconexion.php');
            @$filtro = $_POST['filtro'];
            if(isset($_GET['idCliente']))
            {
                $filtro = $_GET['idCliente'];
            }
            $result=$conn->query("SELECT * FROM clientes
            WHERE idCliente = '$filtro' OR  codigoCliente = '$filtro'");
            
            if (!$result)     
                die("Database access failed: " . mysqli_error()); 
            //output error message if query execution failed 
            
            $rows = mysqli_num_rows($result); 
            // get number of rows returned 
            if ($rows) 
            {     
                /*while($row*/ $datosCliente = $result->fetch_assoc(); /*)*/    
                /*{
                }*/
            }
            else 
            {
                echo '<div class="row">
                        <div class="col-12-md">
                          <div class="alert alert-warning alert-dismissible  show" role="alert">
                            <strong>Sin concidencias</strong> no se encontraron registros.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                  </div>'; 
            }
          }
        ?>
       <div class="Back">
            <i class="fa fa-arrow-left" onclick="Back()"></i>
        </div>
        <div class="row form-inline">
          <div class="col-md-12">
                <label>ID O CLAVE DE CLIENTE:</label>
                <input class="form-control" type="text" name="filtro"  placeholder="Ingrese Id o Clave de vemdedpr"/>
                <span class="Error"></span>
                <input class="btn btn-primary " name="buscar" type="submit" value="Buscar"/>

          </div>
        </div>
        <?php
            if(!empty($datosCliente))
            { 
        ?>
        <p class="h2 text-center">MODIFICAR CLIENTE </p>
        <form action="" method="post">
            <div class="preview text-center">
                <img class="preview-img"src="clientes/<?php echo $datosCliente['fotoCliente']; ?>"alt="Preview Image" width="200" height="200"/>
                <div class="browse-button">
                    <i class="fa fa-pencil-alt"></i>
                    <input class="browse-input" type="file"  name="UploadedFile" id="UploadedFile"/>
                </div>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ID CLIENTE:</label>
                <input class="form-control" type="text" value = "<?php echo $datosCliente['idCliente']; ?>" name="idCliente" readonly required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>NOMBRE COMPLETO:</label>
                <input class="form-control" type="text" name="fullname" value = "<?php echo $datosCliente['descripcionCliente']; ?>" required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>CODIGO CLIENTE:</label>
                <input class="form-control" type="text" value = "<?php echo $datosCliente['codigoCliente']; ?>" readonly name="alias" required placeholder="Ingrese alias vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>COORDENADAS ACTUALES:</label>
                <input class="form-control"  readonly value = "<?php echo $datosCliente['ubicacionCliente']; ?>" type="text" name="coordenadas" required placeholder="Ingrese contraseña"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>NUEVA DIRECCION CLIENTE:</label>
                <input class="form-control" type="text" name="direccion"  placeholder="Ingrese direccion"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>CORREO CLIENTE:</label>
                <input class="form-control" type="email" value = "<?php echo $datosCliente['correoCliente']; ?>" name="email" required placeholder="Ingrese contraseña"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ZONA CLIENTE:</label><br/>
                <input class="form-control" type="number"  value = "<?php echo $datosCliente['zonaCliente']; ?>"name="zona" required placeholder="Ingrese zona vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" name="agregar" type="submit" value="Modificar"/>
            </div>
        </form>
    </div>
    <?php 
            }
        ?>
        </form>
  </body>
  <script>
  // Copy this code in your js file.

function Back()
{
    window.history.back();
}</script>
  <style>
.magia
{
    width: 500px;
    margin: auto;
}
.magia
{
    width: 500px;
    margin: 20px auto;
}


.preview
{
    padding: 10px;
    position: relative;
}

.preview i
{
    color: white;
    font-size: 35px;
    transform: translate(50px,130px);
}

.preview-img
{
    border-radius: 100%;
    box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.7);
}

.browse-button
{
    width: 200px;
    height: 200px;
    border-radius: 100%;
    position: absolute; /* Tweak the position property if the element seems to be unfit */
    top: 10px;
    left: 132px;
    background: linear-gradient(180deg, transparent, black);
    opacity: 0;
    transition: 0.3s ease;
}

.browse-button:hover
{
    opacity: 1;
}

.browse-input
{
    width: 200px;
    height: 200px;
    border-radius: 100%;
    transform: translate(-1px,-26px);
    opacity: 0;
}

.form-group
{
    width:  250px;
    margin: 10px auto;
}

.form-group input
{
    transition: 0.3s linear;
}

.form-group input:focus
{
    border: 1px solid crimson;
    box-shadow: 0 0 0 0;
}

.Error
{
    color: crimson;
    font-size: 13px;
}

.Back
{
    font-size: 25px;
}</style>
</html>