CREATE DATABASE tienda_master;
USE tienda_master;


CREATE TABLE usuarios(
    id int(255) auto_increment not null,
    nombre varchar(100) not null,
    apellidos varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    rol varchar(20),
    imagen varchar(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;
INSERT INTO usuarios VALUES(NULL,'Admin','Admin','admin@admin.com','contraseña','admin', null);


CREATE TABLE categorias(
    id int(255) auto_increment not null,
    nombre varchar(100) not null,
    CONSTRAINT pk_categoria PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categorias values(null,'Manga Corta');
INSERT INTO categorias values(null,'Tirantes');
INSERT INTO categorias values(null,'Manga Larga');
INSERT INTO categorias values(null,'Sudaderas');


CREATE TABLE productos (
    id int(255) auto_increment not null PRIMARY KEY,
    categoria_id int(255) not null,
    nombre varchar(100) not null,
    descripcion text,
    precio float(100,2) not null,
    oferta varchar(2);
    fecha date not null,
    imagen varchar(255),
    stock int(255),
    CONSTRAINT fk_proucto_categoria FOREIGN KEY (categoria_id) references categorias(id) 
)ENGINE=InnoDb;


CREATE TABLE pedidos (
    id int(255) auto_increment not null PRIMARY KEY,
    usuario_id int(255) not null,
    provincia varchar(200) not null,
    localidad varchar(200) not null,
    dirreccion varchar(255) not null,
    coste float(200,2) not null,
    estado varchar(20) not null,
    fecha date,
    hora time,
    CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id) references usuarios(id) 
)ENGINE=InnoDb;


CREATE TABLE lineas_pedidos(
    id int(255) auto_increment not null PRIMARY KEY,
    pedido_id int(255) not null,
    producto_id int(255) not null,
    cantidad int(255) not null,
    CONSTRAINT fk_lineas_pedidos_pedido FOREIGN KEY (pedido_id) references pedidos(id), 
    CONSTRAINT fk_lineas_pedidos_producto FOREIGN KEY (producto_id) references productos(id) 
)ENGINE=InnoDb;