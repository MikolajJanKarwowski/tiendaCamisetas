# Tienda de Camisetas en PHP

Este repositorio contiene una tienda de camisetas básica desarrollada en PHP utilizando el patrón MVC (Modelo-Vista-Controlador) y Programación Orientada a Objetos (POO). La aplicación permite a los usuarios ver y comprar camisetas, así como a los administradores gestionar el inventario y los pedidos.

## Requisitos previos

- PHP 7.0 o superior
- Servidor web (por ejemplo, Apache)
- MySQL 5.6 o superior

## Instalación

1. Clona este repositorio en tu máquina local o descárgalo como archivo ZIP y descomprímelo.
git clone https://github.com/MikolajJanKarwowski/tiendaCamisetas.git
2. Navega hasta el directorio del proyecto.
cd tiendaCamisetas
3. Crea una base de datos en MySQL para la tienda de camisetas.
4. Importa el archivo `database.sql` ubicado en el directorio raíz del proyecto a tu base de datos recién creada. Esto creará las tablas necesarias.
5. Configura la conexión a la base de datos. Abre el archivo `config/db.php` y modifica los valores según tu configuración de MySQL.
6. Configura la URL base de la aplicación. Abre el archivo config/parameters.php y establece el valor de BASE_URL según la URL en la que se alojará la tienda de camisetas.
7. ¡Listo! Ahora puedes acceder a la tienda de camisetas a través de tu navegador utilizando la URL base que configuraste.

## Estructura del proyecto
- controllers: Contiene los controladores que manejan las peticiones y las respuestas.
- models: Contiene las clases que representan los modelos de la aplicación y gestionan las interacciones con la base de datos.
- views: Contiene las plantillas de las vistas de la aplicación.
- uploads: Contiene las imagenes que se mandan a la hora de crear los productos
### El directorio assets contiene los archivos accesibles públicamente.
- css: Contiene los archivos CSS para estilizar la aplicación.
- img: Contiene las imágenes utilizadas en la tienda.
### El directorio config contiene los archivos de configuración de la aplicación.
### El archivo index.php es el punto de entrada de la aplicación.
