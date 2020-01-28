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
        <form action="estadisticasProductos.php" class="form-inline" method="POST">
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
                                $tabla="";
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
                                        $tabla .= "['".$row['codigo']."',".$row['cantidad']."],";
                                        $i++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md text-center">
                        <h2>MAYOR PRODUCTO CON VENTA <?php echo @$mayorVendido; ?></h2>  
                    </div> 
                </div>
                <div class="row">
                    <div class="col-12-md text-center">
                        <h2>GRAFICA DE VENTAS POR PRODUCTO</h2>  
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </form>
  </body>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['PRODUCTO', 'VENDIDOS'],
          <?php echo substr ($tabla, 0, strlen($tabla) - 1); ?>
        ]);

        var options = {
          title: 'Tabla de ventas'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  
</html>