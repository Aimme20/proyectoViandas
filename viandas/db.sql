drop database if exists viandas;
create database viandas;
use viandas;

create table tipo_producto(
  id int not null auto_increment primary key, 
  nombre varchar(50),
  impuesto double
);

insert into tipo_producto values
(NULL, 'Plato Fuerte', 15.32),
(NULL, 'Aperitivo', 10.11),
(NULL, 'Bebida', 9.18);


create table producto(
  id int not null auto_increment primary key, 
  nombre varchar(50),
  precio_compra double,
  precio_venta double,
  existencia int,
  tipo int not null,
  
  foreign key(tipo) references tipo_producto(id)
);

insert into producto values
(NULL, 'Charrones', 9.90, 15.50, 5, 2),
(NULL, 'Cerveza Carta Blanca', 25.30, 29.10, 30, 3),
(NULL, 'Carne Asada', 20.20, 50.00, 20, 1),
(NULL, 'Barbacoa de Pozo', 100.00, 120.30, 15, 1),
(NULL, 'Caguama Indio', 23.90, 28.50, 3, 3);


create table tipo_empleado(
  id int not null auto_increment primary key, 
  nombre varchar(50)
);

insert into tipo_empleado values
(NULL, 'Admin'),
(NULL, 'Cajero');

create table empleado(
  id int not null auto_increment primary key, 
  nombre varchar(50),
  apellidos varchar(50),
  correo varchar(50),
  username varchar(20),
  password varchar(15),
  foto mediumblob,
  sueldo double,
  tipo int not null,
  
  foreign key(tipo) references tipo_empleado(id)
);

insert into empleado values 
(NULL, 'Super', 'User', 'sudo@admin.com', 'super', 'admin', NULL, 0.0, 1);


create table proveedor(
  id int not null auto_increment primary key, 
  nombre varchar(50),
  RFC varchar(15)
);

insert into proveedor values
(NULL, 'Carta Blanca', 'CB12345'),
(NULL, 'Encanto', 'NKT0123'),
(NULL, 'Rancho Sta Elena', 'RSE1234');


create table proveedor_producto(
  idProveedor int not null,
  idProducto int not null,
  
  foreign key(idProveedor) references proveedor(id) on delete cascade,
  foreign key(idProducto) references producto(id) on delete cascade
);

insert into proveedor_producto values
(2, 1), (1, 2), (3, 3), (3, 4), (1,5);


create table venta_temporal(
  id int not null auto_increment primary key, 
  idProducto int not null,
  cantidad int,
  
  foreign key(idProducto) references producto(id)
);

create table venta(
  id int not null auto_increment primary key, 
  fecha datetime,
  inversion double,
  ganancia double,
  utilidad double,
  empleado int,
  calificacion int,
  
  foreign key(empleado) references empleado(id) on delete cascade
);

create table venta_producto(
  idProducto int not null,
  idVenta int not null, 
  cantidad int,
  
  foreign key(idProducto) references producto(id),
  foreign key(idVenta) references venta(id)
);

