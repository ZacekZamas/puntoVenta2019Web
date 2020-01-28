<?php
    $data = json_decode(file_get_contents('php://input'), true);
    date_default_timezone_set('America/Mexico_City');
    
    if(isset($data["button"]) )
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $usuario = $data["usuario"];
        $contrasema = $data["contrasena"];
        //$con goes here 
        $result=$conn->query("SELECT idVendedor,nombreVendedor,fotoVendedor FROM vendedores WHERE aliasVendedor = '$usuario' and codigoVendedor = '$contrasema' ");
        $response["datosVendedor"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
        // get number of rows returned 
        if ($rows) 
        {     
            while($row = $result->fetch_assoc())    
            {

                $datosVendedor= array();

                
                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosVendedor["idVendedor"] = $row['idVendedor'];
                $datosVendedor["nombreVendedor"] = $row['nombreVendedor'];
                $path = 'vendedores/'.$row["fotoVendedor"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $dataf = file_get_contents($path);
                $datosVendedor["fotoVendedor"] = base64_encode($dataf);
                array_push($response["datosVendedor"], $datosVendedor);


                // $response[] = $row;
            }
            // success

            $response["success"] = 1;
        }
        else {
            $datosVendedor["idVendedor"] = "null";
            $datosVendedor["nombreVendedor"] = "null";
            $datosVendedor["fotoVendedor"] = "null";
            array_push($response["datosVendedor"], $datosVendedor);
            $response["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);

    }

    if(isset($data["btnClientes"]) )
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT idCliente,codigoCliente,descripcionCliente,correoCliente FROM clientes");
        $response2["datosCliente"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosCliente= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosCliente["idCliente"] = $row['idCliente'];
                $datosCliente["nombreCliente"] =$row['descripcionCliente'];
                $datosCliente["codigoCliente"] = $row['codigoCliente'];
                $datosCliente["correoCliente"] = $row['correoCliente'];
                array_push($response2["datosCliente"], $datosCliente);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else 
        {
            $datosCliente["idCliente"] = "null";
            $datosCliente["nombreCliente"] = "null";
            $datosCliente["codigoCliente"] = "null";
            $datosCliente["correoCliente"] = "null";
            array_push($response2["datosCliente"], $datosCliente);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data["btnClientes2"]) )
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT idCliente,codigoCliente,descripcionCliente,correoCliente,fotoCliente,zonaCliente,ubicacionCliente FROM clientes");
        $response2["datosCliente"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosCliente= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosCliente["idCliente"] = $row['idCliente'];
                $datosCliente["nombreCliente"] =$row['descripcionCliente'];
                $datosCliente["codigoCliente"] = $row['codigoCliente'];
                $datosCliente["correoCliente"] = $row['correoCliente'];
                $datosCliente["fotoCliente"] = $row['fotoCliente'];
                $datosCliente["zonaCliente"] = $row['zonaCliente'];
                $datosCliente["ubicacionCliente"] = $row['ubicacionCliente'];
                array_push($response2["datosCliente"], $datosCliente);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else 
        {
            $datosCliente["idCliente"] = "null";
            $datosCliente["nombreCliente"] = "null";
            $datosCliente["codigoCliente"] = "null";
            $datosCliente["correoCliente"] = "null";
            $datosCliente["fotoCliente"] = "null";
            $datosCliente["zonaCliente"] = "null";
            $datosCliente["ubicacionCliente"] = "null";
            array_push($response2["datosCliente"], $datosCliente);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data["btnBus2"]) )
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT idProducto,codigoProducto,descripcionProducto,precioProducto,fotoProducto FROM productos");
        $response2["datosProductos"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosProductos= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosProductos["idProducto"] = $row['idProducto'];
                $datosProductos["codigoProducto"] = $row['codigoProducto'];
                $datosProductos["descripcionProducto"] =$row['descripcionProducto'];
                $datosProductos["precioProducto"] = $row['precioProducto'];
                $datosProductos["fotoProducto"] = $row["fotoProducto"];
                
                array_push($response2["datosProductos"], $datosProductos);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else {
            $datosProductos["idProducto"] = "null";
            $datosProductos["codigoProducto"] = "null";
            $datosProductos["descripcionProducto"] = "null";
            $datosProductos["precioProducto"] = "null";
            $datosProductos["fotoProducto"] = "null";

            array_push($response2["datosProductos"], $datosProductos);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data["buscarFoto"]))
    {
        $response2["datosProductos"] = array();
        $path = 'productos/'.$data['fotoProducto'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataf = file_get_contents($path);
        $response2["success"] = base64_encode($dataf);
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
    }

    if(isset($data["buscarFotoC"]))
    {
        $response2["datosProductos"] = array();
        $path = 'clientes/'.$data['fotoCliente'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataf = file_get_contents($path);
        $response2["success"] = base64_encode($dataf);
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
    }

    if(isset($data["btnBus"]) )
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT idProducto,codigoProducto,descripcionProducto,precioProducto FROM productos");
        $response2["datosProductos"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosProductos= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosProductos["idProducto"] = $row['idProducto'];
                $datosProductos["codigoProducto"] = $row['codigoProducto'];
                $datosProductos["descripcionProducto"] =$row['descripcionProducto'];
                $datosProductos["precioProducto"] = $row['precioProducto'];
                array_push($response2["datosProductos"], $datosProductos);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else {
            $datosProductos["idProducto"] = "null";
            $datosProductos["codigoProducto"] = "null";
            $datosProductos["descripcionProducto"] = "null";
            $datosProductos["precioProducto"] = "null";
            array_push($response2["datosProductos"], $datosProductos);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data['btnocodv']) ) // || isset($_GET['a']))
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT MAX(idVenta) AS id FROM ventas");
        $response2["datosCodigo"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {
            while($row = $result->fetch_assoc())    {

            $idVenta= array();
            $cod="VENT00";
            if($row['id']>=10)
            {
                $cod="VENT0";
            }
            else if($row['id']<10)
            {
                $cod="VENT00";
            }
            else if(empty($row["id"]))
            {
                $cod="VENT001"; 
            }
            else 
            {
                $cod="VENT";    
            }
            /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
            $idVenta["idVenta"] = $cod.$row['id'];
            array_push($response2["datosCodigo"], $idVenta);
            // $response2[] = $row;
        }
        // success
        $response2["success"] = 1;

        }
        else 
        {
            $idVenta= array();
            $idVenta["idVenta"] = "VENT001";
            array_push($response2["datosCodigo"], $idVenta);

        }
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);

    }
    if(isset($data['consulaind']))
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $filtro = $data['filtro'];
        //$con goes here 
        $result=$conn->query("SELECT idProducto,codigoProducto,descripcionProducto,precioProducto,fotoProducto FROM productos
        where idProducto = '$filtro' OR codigoProducto = '$filtro'");
        $response2["datosProductos"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosProductos= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosProductos["idProducto"] = $row['idProducto'];
                $datosProductos["codigoProducto"] = $row['codigoProducto'];
                $datosProductos["descripcionProducto"] =$row['descripcionProducto'];
                $datosProductos["precioProducto"] = $row['precioProducto'];
                $path = 'productos/'.$row["fotoProducto"];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $dataf = file_get_contents($path);
                $datosProductos["fotoProducto"] = base64_encode($dataf);
                array_push($response2["datosProductos"], $datosProductos);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else {
            $datosProductos["idProducto"] = "null";
            $datosProductos["codigoProducto"] = "null";
            $datosProductos["descripcionProducto"] = "null";
            $datosProductos["precioProducto"] = "null";
            $datosProductos["fotoProducto"] = "null";

            array_push($response2["datosProductos"], $datosProductos);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data['addsale']))
    {
        $response2["datosAgregarVenta"] = array();

        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");
        $codigoVenta = $data["codVenta"];
        $fechaVenta = date('Y-m-d H:i:s');
        $idCliente = $data['idCliente'];
        $coordenadas = $data['coord'];
        
        $totalSindescuento = $data["totalSinDescuento"];
        $totalCondescuento = $data["totalCondescuento"];
        $descuento =   $totalSindescuento - $totalCondescuento ;
        $importe = $totalCondescuento;
        $iva = $importe * 0.16;
        $totalNeto = $descuento + $iva;
        $idVendedor = $data["idVendedor"];
        $emei = $data["emei"];
        $correo = $data["correo"];
        $atendio = $data["atendio"];
        /*I/System.out: it {"datosAgregarVenta":[],"success":
            "INSERT INTO ventas VALUES(null,'VENT001','2019-11-22 09:35:33',
            '4','19.4755287,-102.0730557',\n        '575.25','92.04','59.75',
            '575.25','151.79','1','356376080947835')"}

        */
        $tt= $totalCondescuento+$iva;
        $sql = "INSERT INTO ventas VALUES(null,'$codigoVenta','$fechaVenta','$idCliente','$coordenadas',
        '$totalSindescuento','$iva','$descuento','$tt','$idVendedor','$emei')";
        $result=  mysqli_query($conn, $sql);
        if ($result) 
        {
            $result=$conn->query("SELECT MAX(idVenta) AS id FROM ventas");
            $idVenta = null;
            while($row = $result->fetch_assoc())    
            {
                $idVenta = $row['id'];
            }
            $i = 0;
            $array= $data["movimientos"];
            $array = explode(",",substr($array,1,-1));
            foreach ((array) $array as $value) {
                list($idProducto, $codigoProducto, $descripcion,$cantidad,$precio,$descuentoInt,$descuentoTotal,$total) = explode('$', $value);
                $codiMov = "MTOVTA".($i+1).$codigoProducto;
                $importe = $precio * $cantidad;
                $n = $i+1;
                $descripcionV = "VENTA PRODUCTO AFILIADO A VENTA: ".$codigoVenta;
                $sql = "INSERT INTO movimientos VALUES(NULL,'$codiMov','$idVenta','$n','$cantidad',
                '$idProducto','$descripcionV','$precio','$importe','$descuentoInt','$total')";
                 $conn->query("$sql");
                $i++;

            }           
            pdf($array,$codigoVenta,$correo,$atendio);
            $response2["success"] = 1;
            
        }
        else 
        {
            $response2["success"] = 0;
        }
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data['btnPerfil']))
    {
        $response2["datosModificar"] = array();

        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $idProducto = $data["idProducto"];
        $descripcionP = $data["descripcionP"];
        $precioP = $data["precioP"];
        $codigoP = $data["codigoP"];
        $image = base64_decode($data["imagen"]);
        $sql = "UPDATE  productos  set codigoProducto = '$codigoP' , precioProducto = '$precioP', descripcionProducto = '$descripcionP',
        fotoProducto = '$codigoP.jpg'  WHERE idProducto = '$idProducto'";
        array_push($response2["datosModificar"], $sql);
        $result=  mysqli_query($conn, $sql);
        if ($result) 
        {
            $lugar = "productos/".$codigoP.".jpg";
            file_put_contents($lugar, $image);
            $response2["success"] = 1;

        }
        else {
            $response2["success"] = 0;

        }
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
        
    }

    if(isset($data['btnPerfil2']))
    {
        $response2["datosModificar"] = array();

        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $idCliente = $data["idCliente"];
        $nombreCliente = $data["nombreCliente"];
        $codigoC = $data["codigoC"];
        $zona = $data["zona"];
        $ubicacion = $data["ubicacion"];
        $imagen = $data["imagen"];
        $image = base64_decode($data["imagen"]);
        $sql = "UPDATE  clientes  set ubicacionCliente = '$ubicacion' , zonaCliente = '$zona', descripcionCliente = '$nombreCliente',
        fotoCliente = '$codigoC.jpg'  WHERE idCliente = '$idCliente'";
        array_push($response2["datosModificar"], $sql);
        $result=  mysqli_query($conn, $sql);
        if ($result) 
        {
            $lugar = "clientes/".$codigoC.".jpg";
            file_put_contents($lugar, $image);
            $response2["success"] = 1;

        }
        else {
            $response2["success"] = 0;

        }
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
        
    }

    function pdf($arreglo,$codigoVenta,$correo,$atendio)
    {
         include "fpdf/fpdf.php";

        $pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
        $textypos = 5;
        $pdf->setY(2);
        $pdf->setX(2);
        $pdf->Cell(5,$textypos,"TU PUNTO DE VENTA");
        $pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
        $textypos+=6;
        $pdf->setX(2);
        $pdf->Cell(5,$textypos,'-------------------------------------------------------------------');
        $textypos+=6;
        $pdf->setX(2);
        $pdf->Cell(5,$textypos,'CANT.  ARTICULO       PRECIO               TOTAL');

        $total =0;
        $off = $textypos+6;
    $i=0;
        $productos = array();
        $totalDescuento=0;
        foreach ((array) $arreglo as $value) {
            list($idProducto, $codigoProducto, $descripcion,$cantidad,$precio,$descuentoInt,$descuentoTotal,$total) = explode('$', $value);
            $producto = array(
                "q"=>$cantidad,
                "name"=>"$descripcion",
                "price"=>$precio
            );
            $totalDescuento+=($cantidad*$precio*($descuentoInt/100));
            array_push($productos,$producto);
            $i++;

        }   

       $m=0;
        foreach($productos as $pro){
                     $total+=number_format($pro["q"]*$pro["price"],2,".",",") ;

        $pdf->setX(2);
        $pdf->Cell(5,$off,$pro["q"]);
        $pdf->setX(6);
        $pdf->Cell(35,$off,  strtoupper(substr($pro["name"], 0,12)) );
        $pdf->setX(20);
        $pdf->Cell(11,$off,  "$".number_format($pro["price"],2,".",",") ,0,0,"R");
        $pdf->setX(32);
        $pdf->Cell(11,$off,  "$ ".number_format($pro["q"]*$pro["price"],2,".",",") ,0,0,"R");

        $off+=6;
                $m++;

        }
        $textypos=$off+6;


        $iva = $total * .16;
        $pdf->setX(2);
        $pdf->Cell(5,$textypos,"IVA 16%: " );
        $pdf->setX(38);
        $pdf->Cell(5,$textypos,"$ ".number_format($iva,2,".",","),0,0,"R");
        $textypos=$off+12;

        $pdf->setX(2);
        $pdf->Cell(5,$textypos,"DESCUENTO " );
        $pdf->setX(38);
        $pdf->Cell(5,$textypos,"$ ".number_format($totalDescuento,2,".",","),0,0,"R");
        $textypos=$off+18;

        $pdf->setX(2);
        $pdf->Cell(5,$textypos,"SUBTOTAL: " );
        $pdf->setX(38);
        $pdf->Cell(5,$textypos,"$ ".number_format($total,2,".",","),0,0,"R");
        $textypos=$off+24;
        $pdf->setX(2);
        $pdf->Cell(5,$textypos,"TOTAL: " );
        $pdf->setX(38);
        $pdf->Cell(5,$textypos,"$ ".number_format(($total-$totalDescuento)+$iva,2,".",","),0,0,"R");
        $textypos=$off+27;
        $pdf->setX(2);
        $pdf->Cell(5,$textypos+20,'LE ATENDIO:'.$atendio);
        $pdf->setX(2);
        $pdf->Cell(5,$textypos+30,'GRACIAS POR TU COMPRA ');

        $pdf->output($codigoVenta.".pdf","F");
                rename ($codigoVenta.".pdf","tickets/$codigoVenta.pdf");
        correo("tickets/$codigoVenta.pdf",$correo,$codigoVenta);


    }

    function correo($filename,$para,$codVenta)
    {
        
        $file = $filename;
    
        $mailto = $para;
        $subject = 'TICKET DE VENTA '.$codVenta;
        $message = 'GRACIAS POR SU COMPRA LE ADJUNTAMOS TICKET DE COMPRA';
    
        $content = file_get_contents($file);
        $content = chunk_split(base64_encode($content));
    
        // a random hash will be necessary to send mixed content
        $separator = md5(time());
    
        // carriage return type (RFC)
        $eol = "\r\n";
    
        // main header (multipart mandatory)
        $headers = "From: TU PUNTO DE VENTA <puntoventadogo@gmail.com>" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol;
    
        // message
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol;
        $body .= $message . $eol;
    
        // attachment
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol;
        $body .= $content . $eol;
        $body .= "--" . $separator . "--";
    
        //SEND Mail
        if (mail($mailto, $subject, $body, $headers)) {
            //echo "mail send ... OK"; // or use booleans here
        } else {
            //echo "mail send ... ERROR!";
            //print_r( error_get_last() );
        }
    }
    
      if(isset($data['consultaUsuario']))
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $filtro = $data['filtro'];
        //$con goes here 
        $result=$conn->query("SELECT * FROM vendedores
        where idVendedor = '$filtro' ");
        $response2["datosVendedor"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosVendedor= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosVendedor["nombreVendedor"] = $row['nombreVendedor'];
                $datosVendedor["codigoVendedor"] = $row['codigoVendedor'];
                $datosVendedor["zonaVenta"] =$row['zonaVenta'];
                $datosVendedor["aliasVendedor"] = $row['aliasVendedor'];
               
                array_push($response2["datosVendedor"], $datosVendedor);
                // $response2[] = $row;
            }
            // success
            $response2["success"] = 1;
            

        }
        else {
            $datosVendedor["nombreVendedor"] = "null";
            $datosVendedor["codigoVendedor"] = "null";
            $datosVendedor["zonaVenta"] = "null";
            $datosVendedor["aliasVendedor"] = "null";

            array_push($response2["datosVendedor"], $datosVendedor);
            $response2["success"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }

    if(isset($data['modUser']))
    {
        $response2["datosModificar"] = array();

        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");

        $idVendedor = $data["idVendedor"];
        $nombreVendedor = $data["nombreVendedor"];
        $zonaVenta = $data["zonaVenta"];
        $contrasena = $data["contrasena"];
        $imagen = $data["imagen"];
        $image = base64_decode($data["imagen"]);
        $sql = "UPDATE  vendedores  set nombreVendedor = '$nombreVendedor' , zonaVenta = '$zonaVenta',
         codigoVendedor = '$contrasena', fotoVendedor = '$imagen.jpg'
         WHERE idVendedor = '$idVendedor'";
        array_push($response2["datosModificar"], $sql);
        $result=  mysqli_query($conn, $sql);
        if ($result) 
        {
            $lugar = "clientes/".$codigoC.".jpg";
            file_put_contents($lugar, $image);
            $response2["success"] = 1;

        }
        else {
            $response2["success"] = 0;

        }
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
    }
    if(isset($data['obtVentas']))
    {
        include('dbconexion.php');
        mysqli_set_charset($conn, "utf8");


        //$con goes here 
        $result=$conn->query("SELECT sum(ventas.totalNetoVenta) as total, vendedores.aliasVendedor as nombre FROM ventas  
        INNER JOIN
        vendedores on vendedores.idVendedor = ventas.idVendedor  GROUP BY ventas.idVendedor asc");
        $response2["datosVenta"] = array();
        if (!$result)     
            die("Database access failed: " . mysqli_error()); 
        //output error message if query execution failed 
        
        $rows = mysqli_num_rows($result); 
            // get number of rows returned 
        if ($rows) 
        {     

            while($row = $result->fetch_assoc())    {

                $datosVenta= array();

                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosVenta["total"] = $row['total'];
                $datosVenta["nombre"] = $row['nombre'];
                
                
                array_push($response2["datosVenta"], $datosVenta);
                // $response2[] = $row;
            }
            // success
            $response2["success1"] = 1;
            $response2["masVendido"] = array();
            $result=$conn->query("SELECT sum(movimientos.cantidadProducto) as cantidad, 
            productos.codigoProducto as codigo,productos.descripcionProducto as nombre from 
            movimientos INNER JOIN productos on productos.idProducto = movimientos.idProducto 
            GROUP BY movimientos.idProducto order by cantidad desc");
            $rows = mysqli_num_rows($result); 
            if ($rows) 
            {
                while($row = $result->fetch_assoc())    
                {

                    $datosVenta= array();

                    /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                    $datosVenta["cantidad"] = $row['cantidad'];
                    $datosVenta["nombre"] = $row['nombre'];
                    $datosVenta["codigo"] = $row['codigo'];
                    
                    array_push($response2["masVendido"], $datosVenta);
                    // $response2[] = $row;
                }
                $response2["success2"] = 1;

            }
            else 
            {
               
                /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
                $datosVenta["cantidad"] = "null";
                $datosVenta["nombre"] = "null";
                $datosVenta["codigo"] = "null";
                
                array_push($response2["masVendido"], $datosVenta); 
                $response2["success2"] = 0;
            }  
            

        }
        else {
                $datosVenta["total"] = "null";
                $datosVenta["nombre"] = "null";

            array_push($response2["datosVenta"], $datosVenta);
            $response2["success1"] = 0;
        }
        /* CLOSE THE CONNECTION */
        echo(json_encode($response2,JSON_UNESCAPED_UNICODE));
        mysqli_close($conn);
        
    }

    

?>