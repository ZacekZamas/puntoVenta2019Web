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
        <form action="modificarProducto.php" method="POST" enctype="multipart/form-data">
        <div class="container magia">
        <?php
          if(isset($_POST['agregar']))
          {
            include('dbconexion.php');
            $nombre = $_POST['fullname'];
            $codigo = $_POST['codigo'];
            $precio = $_POST['precio'];
            $idProducto = $_POST['idProducto'];
            $ruta= './productos/'.$codigo.'.jpg'; 
            $foto=$codigo.'.jpg';	 
            if (isset($_FILES['UploadedFile']['name']) && !empty($_FILES['UploadedFile']['name']))
            {
              if(move_uploaded_file($_FILES['UploadedFile']['tmp_name'],$ruta))
              {
                  $foto = $codigo.'.jpg';
              }
              
            }
            /*else 
            {
              $file = './vendedores/generico.jpg';
              $newfile = './vendedores/'.$alias.'.jpg';;
              copy($file, $newfile);
            }*/
             $sql = "UPDATE productos set precioProducto = '$precio', descripcionProducto = '$nombre'
            WHERE idProducto = '$idProducto'";
            $result=$conn->query($sql);
            if ($result === TRUE) {
              echo '<div class="row">
                    <div class="col-12-md">
                      <div class="alert alert-success alert-dismissible  show" role="alert">
                        <strong>Modificacion Exitosa</strong> El producto ha sido modificado exitosamente.
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
                            <strong>Modificacion Fallida</strong> El producto no ha sido modificado vuelva a intentarlo.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                  </div>';
            }
          }
          $datosProducto="";
          if(isset($_POST['buscar']) || isset($_GET['idProducto']))
          {
            include('dbconexion.php');
            @$filtro = $_POST['filtro'];
            if(isset($_GET['idProducto']))
            {
                $filtro = $_GET['idProducto'];
            }
            $result=$conn->query("SELECT * FROM productos
            WHERE idproducto = '$filtro' OR  codigoProducto = '$filtro'");
            
            if (!$result)     
                die("Database access failed: " . mysqli_error()); 
            //output error message if query execution failed 
            
            $rows = mysqli_num_rows($result); 
            // get number of rows returned 
            if ($rows) 
            {     
                /*while($row*/ $datosProducto = $result->fetch_assoc(); /*)*/    
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
                <label>ID O CLAVE DE PRODUCTO:</label>
                <input class="form-control" type="text" name="filtro"  placeholder="Ingrese Id o Clave de vemdedpr"/>
                <span class="Error"></span>
                <input class="btn btn-primary " name="buscar" type="submit" value="Buscar"/>

          </div>
        </div>
        <?php
            if(!empty($datosProducto))
            { 
        ?>
        <p class="h2 text-center">MODIFICAR PRODUCTO</p>
        <form action="" method="post">
            <div class="preview text-center">
                <img class="preview-img" src="productos/<?php echo $datosProducto['fotoProducto']; ?>" alt="Preview Image" width="200" height="200"/>
                <div class="browse-button">
                    <i class="fa fa-pencil-alt"></i>
                    <input class="browse-input" type="file"  name="UploadedFile" id="UploadedFile"/>
                </div>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ID PRODUCTO:</label>
                <input class="form-control" type="text"  readonly value="<?php echo $datosProducto['idProducto'];?>" name="idProducto" required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>NOMBRE PRODUCTO:</label>
                <input class="form-control" type="text" value="<?php echo $datosProducto['descripcionProducto'];?>" name="fullname" required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>CODIGO PRODUCTO:</label>
                <input class="form-control" type="text" value="<?php echo $datosProducto['codigoProducto'];?>" readonly  name="codigo" required placeholder="Ingrese alias vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>PRECIO PRODUCTO:</label>
                <input class="form-control" type="number" value="<?php echo $datosProducto['precioProducto'];?>"  step="any" name="precio" required placeholder="Ingrese contraseña"/>
                <span class="Error"></span>
            </div>
            
            <div class="form-group">
                <input class="btn btn-primary btn-block" name="agregar" type="submit" value="Modificar"/>
            </div>
        </form>
        <?php 
            }
        ?>
    </div>
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