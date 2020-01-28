<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="imagenes/generales/ventas.png">

  <?php  include 'header.php'?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <title>Punto de venta</title>
  
  </head>
    <body>
        <form action="consultaVentas.php" class="form-inline" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-12-md text-center">
                        <div class="form-group">
                            <label for="fechaI">Fecha Inicial: </label>
                            <input class="form-control" value="<?php if(isset($_POST['fechaInicial'])){ echo $_POST['fechaInicial'];}else{ echo date('Y-m-d');}?>" type="date" name="fechaInicial" min="01-01-2010"  required>
                            <label for="fechaF">Fecha Final: </label>
                            <input class="form-control" value="<?php if(isset($_POST['fechaFinal'])){ echo $_POST['fechaFinal'];}else{ echo date('Y-m-d');}?>"  type="date" name="fechaFinal" min="01-01-2010"  required>
                            <input  class="form-control" type="submit" name="consultar" value="consultar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12-md">
                        <?php 
                            if(isset($_POST['fechaInicial']) && isset($_POST['fechaFinal']))
                            {
                                $fechaI = $_POST['fechaInicial'];
                                $fechaF =$_POST['fechaFinal'];
                            }
                            else 
                            {
                                $fechaI = date('Y-m-d');
                                $fechaF = date('Y-m-d');
                            }
                            include('dbconexion.php');
                            $sql = "SELECT sum(ventas.totalNetoVenta) as totalVenta from ventas WHERE
                             ventas.fechaVenta >= '$fechaI 00:00:00' and ventas.fechaVenta <= '$fechaF 23:59:59';";
                            $result=$conn->query($sql);
                            $rows = mysqli_num_rows($result); 
                            $ventaTotal;
                            // get number of rows returned 
                            if ($rows) 
                            {     
                                
                                while($row = $result->fetch_assoc())    
                                {
                                    $ventaTotal = $row['totalVenta'];
                                }
                            }
                        ?>
                         <div class="form-group">
                            <label for="fechaI">Venta total acumulada: </label>
                            <input  class="form-control" type="text" name="consultar" value="<?php echo $ventaTotal;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12-md text-center">
                        <h2>VENTAS POR PRODUCTO</h2>  
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md">
                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>CANTIDAD</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                            </thead>
                            <tbody>
                            <?php 
                                $sql = "SELECT sum(movimientos.cantidadProducto) as cantidad, 
                                productos.codigoProducto as codigo,productos.descripcionProducto as nombre from 
                                movimientos 
                                INNER JOIN productos on productos.idProducto = movimientos.idProducto 
                                INNER JOIN ventas on ventas.idVenta = movimientos.idVenta
                                WHERE ventas.fechaVenta >= '$fechaI 00:00:00' and ventas.fechaVenta <= '$fechaF 23:59:59'
                                GROUP BY movimientos.idProducto order by cantidad desc
                                ";
                                $result=$conn->query($sql);
                                $rows = mysqli_num_rows($result); 
                                $ventaTotal;
                                // get number of rows returned 
                                if ($rows) 
                                {     
                                    $i=1;
                                    $mayorVendido="";
                                    while($row = $result->fetch_assoc())    
                                    {
                                        if($i==1)
                                        {
                                            $mayorVendido = $row['nombre'];
                                        }
                                        echo "<tr>
                                                <td>$i</td>
                                                <td>".$row['cantidad']."</td>
                                                <td>".$row['codigo']."</td>
                                                <td>".$row['nombre']."</td>
                                              </tr>  
                                        ";
                                        $i++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md">
                        <div class="form-group">
                            <label for="fechaI">MAYOR PRODUCTO VENDIDO: </label>
                            <input  class="form-control" type="text" name="consultar" value="<?php echo $mayorVendido;?>" readonly>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md text-center">
                        <h2>VENTAS POR VENDEDOR</h2>  
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md">
                    <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>TOTAL VENTA</th>
                            </thead>
                            <tbody>
                            <?php 
                                $sql = "SELECT sum(ventas.totalNetoVenta) as total, vendedores.aliasVendedor as nombre FROM ventas  
                                INNER JOIN vendedores on vendedores.idVendedor = ventas.idVendedor
                                WHERE ventas.fechaVenta >= '$fechaI 00:00:00' and ventas.fechaVenta <= '$fechaF 23:59:59'
                                 GROUP BY ventas.idVendedor asc
                                ";
                                $result=$conn->query($sql);
                                $rows = mysqli_num_rows($result); 
                                $ventaTotal;
                                // get number of rows returned 
                                if ($rows) 
                                {     
                                    $i=1;
                                    $maskbron="";
                                    while($row = $result->fetch_assoc())    
                                    {
                                        if($i==1)
                                        {
                                            $maskbron = $row['nombre'];
                                        }
                                        echo "<tr>
                                                <td>$i</td>
                                                <td>".$row['nombre']."</td>
                                                <td>$".$row['total']."</td>
                                              </tr>  
                                        ";
                                        $i++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md">
                        <div class="form-group">
                            <label for="fechaI">VENDEDOR CON MAYOR VENTA: </label>
                            <input  class="form-control" type="text" name="consultar" value="<?php echo $maskbron;?>" readonly>
                        </div>
                    </div> 
                </div>
            </div>
        </form>
        <br>
        <br>
  </body>
  
</html>