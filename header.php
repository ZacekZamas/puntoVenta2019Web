<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<header>
<div class="top_bar">
<div class="container">
<div class="col-md-6">
<ul class="social">
<!--<li><a target="_blank" href="https://www.webenlance.com/"><i class="fa fa-facebook text-white"></i></a></li>
<li><a target="_blank" href="https://webenlance.com"><i class="fa fa-twitter text-white"></i></a></li>
<li><a target="_blank" href="http://webenlance.com"><i class="fa fa-instagram text-white"></i></a></li>-->
</ul></div>

<div class="col-md-6">
<ul class="rightc">
<li><i ></i> Punto de venta  </li>
<li><i ></i><?php echo "Uruapan Michoacan a:  ".date('Y-m-d');?></li>      
</ul>
</div>
</div>
</div>
<!--top_bar-->



<nav class="navbar navbar-default" role="navigation">
    	<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="imagenes/generales/sales.png" width="100" height="50"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Inicio</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span></span>Ventas</a>
						<ul class="dropdown-menu">
							<li><a href="consultaVentas.php">Reporte de ventas</a></li>
							
						</ul>
					</li>
                    <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span></span>Vendedores</a>
						<ul class="dropdown-menu">
							<li><a href="altaVendedor.php">Alta Vendedores</a></li>
							<li><a href="modificarVendedores.php">Modificacion Vendedores</a></li>
							<li><a href="reporteVendedores.php">Vendedores Registrados</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span></span>Clientes</a>
						<ul class="dropdown-menu">
							<li><a href="altaCliente.php">Alta Clientes</a></li>
							<li><a href="modificarcliente.php">Modificacion Clientes</a></li>
							<li><a href="reporteClientes.php">Clientes Registrados</a></li>
						
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span></span>Productos</a>
						<ul class="dropdown-menu">
							<li><a href="altaProducto.php">Alta Productos</a></li>
							<li><a href="modificarProducto.php">Modificacion Productos</a></li>
							<li><a href="reporteProductos.php">Productos Registrados</a></li>
							<li><a href="estadisticasProductos.php">Estadisticas Productos</a></li>
						</ul>
					</li>
				</ul>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
   
</header>




<style>
.top_bar { min-height:40px; /* 
background: #30bed6; /* Old browsers */
background: -moz-linear-gradient(left, #30bed6 0%, #38cac9 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, #30bed6 0%,#38cac9 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, #30bed6 0%,#38cac9 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#30bed6', endColorstr='#38cac9',GradientType=1 ); /* IE6-9 */}

.social { list-style-type:none; margin-bottom:0px; float:left; padding:0px; margin-left:0px;}
.social li { float:left;}
.social li a { padding:0 10px; font-size:13px; line-height:40px; color:#FFF;}

.rightc { list-style-type:none; margin-bottom:0px; float:right;}
.rightc li { margin:0px 10px; font-size:13px; float:left; line-height:40px; color:#FFF;}
.rightc li a {   color:#FFF; }

.navbar-brand img { margin-top:0px; margin-left:0px;}
.navbar-brand {padding:0px;}

.header_image { margin-top:-70px; float:left;}
.nav.navbar-nav.navbar-right span {font-family: 'Open Sans', sans-serif; font-style:italic; font-weight:300; color:#1b6977;}
.navbar-right li a {font-family: 'Open Sans', sans-serif; font-size:16px; color:#1b6977 !important;}
</style>
<script>

$(document).ready(function(){

$(".dropdown").hover(            

    function() {

        $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");

        $(this).toggleClass('open');        

    },

    function() {

        $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");

        $(this).toggleClass('open');       

    }

);

});</script>