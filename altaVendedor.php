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
        <form action="altaVendedor.php" method="POST" enctype="multipart/form-data">
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
            $foto='generico.jpg';	 
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
            $sql = "INSERT INTO vendedores VALUES(null,'$contra','$zona','$nombre','$alias','$foto')";
            $result=$conn->query($sql);
            if ($result === TRUE) {
              echo '<div class="row">
                    <div class="col-12-md">
                      <div class="alert alert-success alert-dismissible  show" role="alert">
                        <strong>Registro Exitoso</strong> El vendedor ha sido registrado exitosamente.
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
                            <strong>Registro Fallido</strong> El vendedor no ha sido registrado vuelva a intentarlo.
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
        <p class="h2 text-center">AGREGAR VENDEDOR NUEVO</p>
        <form action="" method="post">
            <div class="preview text-center">
                <img class="preview-img" src="vendedores/generico.jpg" alt="Preview Image" width="200" height="200"/>
                <div class="browse-button">
                    <i class="fa fa-pencil-alt"></i>
                    <input class="browse-input" type="file"  name="UploadedFile" id="UploadedFile"/>
                </div>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>NOMBRE COMPLETO:</label>
                <input class="form-control" type="text" name="fullname" required placeholder="Ingrese nombre completo"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ALIAS VENDEDOR:</label>
                <input class="form-control" type="text" name="alias" required placeholder="Ingrese alias vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>CONTRASEÑA:</label>
                <input class="form-control" type="password" name="password" required placeholder="Ingrese contraseña"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <label>ZONA VENDEDOR:</label><br/>
                <input class="form-control" type="number" name="zona" required placeholder="Ingrese zona vendedor"/>
                <span class="Error"></span>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" name="agregar" type="submit" value="Agregar"/>
            </div>
        </form>
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