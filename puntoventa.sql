create database puntoventa;
use puntoventa;
create table productos(idProducto int not null primary key auto_increment, codigoProducto varchar(100),
precioProducto double, descripcionProducto varchar(100)) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1;

create table clientes(idCliente int not null primary key auto_increment, codigoCliente varchar(100),
descripcionCliente varchar(100), zonaCliente int, ubicacionCliente varchar(100), fotoCliente varchar(100)) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

create table vendedores(idVendedor int not null primary key auto_increment, codigoVendedor varchar(100),
zonaVenta int, nombreVendedor varchar(100), aliasVendedor varchar(100)) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

create table ventas(idVenta int not null primary key auto_increment,codigoVenta varchar(100),fechaVenta datetime, idCliente int, foreign key(idCliente)
references clientes(idCliente), ubicacionVenta varchar(100), importeVenta double, ivaVenta double, descuentoVenta int, 
totalNetoVenta double, idVendedor int, foreign key(idVendedor) references vendedores(idVendedor)) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

create table movimientos(idMovimiento int not null primary key auto_increment, codigoMovimiento varchar(100), idVenta int, foreign key(idVenta) references ventas(idVenta),
numMovimiento int, cantidadProducto int, idProducto int, foreign key(idProducto) references productos(idProducto), 
descripcionMovimiento varchar(50), precioUnitarioProducto double, importeProducto double, descuentoMovimiento int, totalMovimiento double) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;