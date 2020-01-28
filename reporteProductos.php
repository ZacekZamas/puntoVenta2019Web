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
        <form action="reporteProductos.php" class="form-inline" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar Producto" title="Escribe un nombre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12-md">
                    <table id="myTable" class="table table-responsive table-hover table-bordered">
                            <thead class="header">
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>CODIGO</th>
                                <th>PRECIO</th>
                                <th>CONSULTAR</th>
                            </thead>
                            <tbody>
                            <?php 
                                include 'dbconexion.php';
                                $sql = "SELECT * FROM productos";
                                $result=$conn->query($sql);
                                $rows = mysqli_num_rows($result); 
                                // get number of rows returned 
                                if ($rows) 
                                {     
                                    $i=1;
                                    while($row = $result->fetch_assoc())    
                                    {
                                        
                                        echo
                                            "<tr>
                                                <td>$i</td>
                                                <td>".$row['descripcionProducto']."</td>
                                                <td>".$row['codigoProducto']."</td>
                                                <td>$ ".$row['precioProducto']."</td>
                                                <td><button><a style='text-decoration:none;' target='_blank' href = 'modificarProducto.php?idProducto=".$row['idProducto']."'>Consultar</a></button></td>
                                            </tr>";
                                        $i++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
  </body>
  <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

  <style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</html>