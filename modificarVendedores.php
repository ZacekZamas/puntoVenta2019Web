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
        <form action="modificarVendedores.php" method="POST" enctype="multipart/form-data">
        <div class="container magia">
        <?php
          if(isset($_POST['agregar']))
          {
            include('dbconexion.php');
            $nombre = $_POST['fullname'];
            $alias = $_POST['alias'];
            $contra = $_POST['password'];
            $zona = $_POST['zona'];
            $ruta= './vendedores/'.$alias.'.jpg'; 
            $foto=$alias.'.jpg';
            $idVendedor = $_POST['idVendedor'];	 
            if (isset($_FILES['UploadedFile']['name']) && !empty($_FILES['UploadedFile']['name']))
            {
              if(move_uploaded_file($_FILES['UploadedFile']['tmp_name'],$ruta))
              {
                $foto = $alias.'.jpg';
              }
              
            }	 
            /*else 
            {
              $file = './vendedores/generico.jpg';
              $newfile = './vendedores/'.$alias.'.jpg';;
              copy($file, $newfile);
            }*/
            $sql = "UPDATE vendedores SET codigoVendedor = '$contra', zonaVenta = '$zona',
            nombreVendedor = '$nombre', fotoVendedor = '$foto' 
            WHERE idVendedor = '$idVendedor'";
            $result=$conn->query($sql);
            if ($result === TRUE) {
              echo '<div class="row">
                    <div class="col-12-md">
                      <div class="alert alert-success alert-dismissible  show" role="alert">
                        <strong>Modificacion Exitosa</strong> El vendedor ha sido modificado exitosamente.
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
                            <strong>Modificacion Fallida</strong> El vendedor no ha sido modificado vuelva a intentarlo.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                  </div>';
            }
          }
          $datosVendedor="";
          if(isset($_POST['buscar']) || isset($_GET['idVendedor']))
          {
            include('dbconexion.php');
            @$filtro = $_POST['filtro'];
            if(isset($_GET['idVendedor']))
            {
                $filtro = $_GET['idVendedor'];
            }
            $result=$conn->query("SELECT * FROM vendedores
            WHERE idVendedor = '$filtro' OR  aliasVendedor = '$filtro'");
            
            if (!$result)     
                die("Database access failed: " . mysqli_error()); 
            //output error message if query execution failed 
            
            $rows = mysqli_num_rows($result); 
            // get number of rows returned 
            if ($rows) 
            {     
                /*while($row*/ $datosVendedor = $result->fetch_assoc(); /*)*/    
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
                <label>ID O CLAVE DE VENDEDOR:</label>
                <input class="form-control" type="text" name="filtro"  placeholder="Ingrese Id o Clave de vemdedpr"/>
                <span class="Error"></span>
                <input class="btn btn-primary " name="buscar" type="submit" value="Buscar"/>

          </div>
        </div>
       
        <?php
            if(!empty($datosVendedor))
            { 
        ?>
        <p class="h2 text-center">MODIFICAR VENDEDOR </p>
        <form action="" method="post">
            <div class="preview text-center">
                <img class="preview-img" src="vendedores/<?php echo $datosVendedor['fotoVendedor']; ?>" alt="Preview Image" width="200" height="200"/>
                <div class="browse-button">
                    <i class="fa fa-pencil-alt"></i>
                    <input class="browse-input" type="file"  name="UploadedFile" id="UploadedFile"/>
                </div>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ID VENDEDOR:</label>
                <input class="form-control" type="text" value="<?php echo $datosVendedor['idVendedor']; ?>" name="idVendedor" required readonly placeholder="Ingrese id"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>NOMBRE COMPLETO:</label>
                <input class="form-control" type="text" value="<?php echo $datosVendedor['nombreVendedor']; ?>" name="fullname" required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ALIAS VENDEDOR:</label>
                <input class="form-control" value="<?php echo $datosVendedor['aliasVendedor']; ?>" readonly type="text" name="alias" required placeholder="Ingrese alias vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>CONTRASEÑA:</label>
                <input class="form-control" id="myInput" value="<?php echo $datosVendedor['codigoVendedor']; ?>" type="password" name="password" required placeholder="Ingrese contraseña"/>
                <input type="checkbox" onclick="myFunction()">VER CONTRASEÑA
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ZONA VENDEDOR:</label><br/>
                <input class="form-control" type="number" value="<?php echo $datosVendedor['zonaVenta']; ?>" name="zona" required placeholder="Ingrese zona vendedor"/>
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
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
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