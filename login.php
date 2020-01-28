<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="imagenes/generales/ventas.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php
        @session_start();
        $_SESSION['idVendedor'] = "0";
        if(isset($_POST['iniciar']))
        {
            include('dbconexion.php');
            $usuario = $_POST['user'];
            $contrasena = $_POST['password'];
            $sql = "SELECT idVendedor, codigoVendedor FROM vendedores WHERE codigoVendedor = '$contrasena' AND aliasVendedor = '$usuario'";
            echo $sql;
            $result = mysqli_query($conn,$sql);
            if (!$result)     
                die("Database access failed: " . mysqli_error()); 
                //output error message if query execution failed 
                
            $rows = mysqli_num_rows($result); 
                // get number of rows returned 
            if ($rows) {     
            
               
                while ($row = mysqli_fetch_array($result)) {         
                    $_SESSION['idVendedor']=$row['idVendedor'];
                } 
            }  
            else
            {
                $_SESSION['idVendedor']="0";
            } 
            if($_SESSION['idVendedor']!=0)
            {
                header('Location: index.php');
            } 
            mysqli_close($conn);

        } 
        if(isset($_POST['registrarse']))
        {
            header('Location: register.php');

        }
    ?>
    <title>Punto venta</title>
  </head>
  <body>
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <div class="login-container">
                <div id="output"></div>
                    <label>Bienvenido a:</label>
                    <br>
                    <label>Punto de venta</label>
                  
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form action="login.php" method="post">
                            <input name="user" type="text" placeholder="Ingrese usuario">
                            <input name="password" type="password" placeholder="Ingrese codigo">
                            <button name="iniciar" class="btn btn-info btn-block login" >Iniciar Sesión</button>
                            <button name="registrarse"  class="btn btn-info btn-block login" >Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <style>
        body{background: #eee url(imagenes/generales/fondo.jpeg);}
        html,body{
            position: relative;
            height: 100%;
        }

        .login-container{
            position: relative;
            width: 300px;
            margin: 80px auto;
            padding: 20px 40px 40px;
            text-align: center;
            background: #fff;
            border: 1px solid #ccc;
        }

        #output{
            position: absolute;
            width: 300px;
            top: -75px;
            left: 0;
            color: #fff;
        }

        #output.alert-success{
            background: rgb(25, 204, 25);
        }

        #output.alert-danger{
            background: rgb(228, 105, 105);
        }


        .login-container::before,.login-container::after{
            content: "";
            position: absolute;
            width: 100%;height: 100%;
            top: 3.5px;left: 0;
            background: #fff;
            z-index: -1;
            -webkit-transform: rotateZ(4deg);
            -moz-transform: rotateZ(4deg);
            -ms-transform: rotateZ(4deg);
            border: 1px solid #ccc;

        }

        .login-container::after{
            top: 5px;
            z-index: -2;
            -webkit-transform: rotateZ(-2deg);
            -moz-transform: rotateZ(-2deg);
            -ms-transform: rotateZ(-2deg);

        }

        .avatar{
            width: 100px;height: 100px;
            margin: 10px auto 30px;
            border-radius: 100%;
            border: 2px solid #aaa;
            background-size: cover;
        }

        .form-box input{
            width: 100%;
            padding: 10px;
            text-align: center;
            height:40px;
            border: 1px solid #ccc;;
            background: #fafafa;
            transition:0.2s ease-in-out;

        }

        .form-box input:focus{
            outline: 0;
            background: #eee;
        }

        .form-box input[type="text"]{
            border-radius: 5px 5px 0 0;
            text-transform: lowercase;
        }

        .form-box input[type="password"]{
            border-radius: 0 0 5px 5px;
            border-top: 0;
        }

        .form-box button.login{
            margin-top:15px;
            padding: 10px 20px;
        }

        .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInUp {
        0% {
            opacity: 0;
            -webkit-transform: translateY(20px);
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
        }

        @keyframes fadeInUp {
        0% {
            opacity: 0;
            -webkit-transform: translateY(20px);
            -ms-transform: translateY(20px);
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            -ms-transform: translateY(0);
            transform: translateY(0);
        }
        }

        .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
        }
</style>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script >
    $(function(){
        var comprobar =<?php echo $_SESSION['idVendedor']?>;

            var textfield = $("input[name=user]");
            var passField = $("input[name=password]");
            $(".avatar").css({
                    "background-image": "url('imagenes/generales/login.png')"
            });
      
});

       
    </script>  
</body>
</html>