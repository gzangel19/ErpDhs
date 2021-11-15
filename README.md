# ERP DHS

Los sistemas de planificación de recursos empresariales (ERP, por sus siglas en inglés, enterprise resource planning) realizado para la el GRUPO DHS, el sistema permite la administracion de multiples sucursales y multiples unidades de negocio, a su vez realiza el mantenimientoy seguimiento individual de las ventas realizadas, el control de stock y cartera de vendedores de cada sucursal y de cada unidad de negocio. A su vez el ERP cuenta con una seccion de API que es utilizado para otro Software de la propia empresa DHS.

# Construido con 🛠️

##### Lenguaje de Programacion

<p align="left"> 
    <a href="https://www.php.net/" target="_blank"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="65" height="65"/> 
</p>
        
____
 
##### FrontEnd Development

<p align="left>
    <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="javascript" width="65" height="65"/> 
<a href="https://getbootstrap.com" target="_blank"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="bootstrap" width="65" height="65"/> </a> 
<a href="https://www.w3schools.com/css/" target="_blank"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="css3" width="65" height="65"/> </a> 

____

##### Backend Development
<p align="left">  
               <a href="https://laravel.com/" target="_blank"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="65" height="65"/> </a>
</p>

# Pre-requisitos 📋

En este Proyecto fue realizado con con Laravel 7, el cual requiere de PHP 7.2 o superior, la extensión PDO para el trabajo con base de datos, así como de otras extensiones que puedes ver en la documentación de <a href="https://laravel.com/docs/7.x">Laravel </a>. Asegúrate de que tu entorno de desarrollo cumpla con estos requisitos, de lo contrario revisa el material relacionado debajo del video o la sección de comentarios.

# Instalación 🔧

Una vez hayamos clonado el repositorio de nuestro proyecto Laravel en local, debemos hacer los siguientes ajustes para que éste pueda correr en nuestro equipo.

- Instalar dependencias
- Crear una base de datos
- Crear el archivo .env
- Generar una clave
- Migrar la base de datos

## Instalar dependencias

Instalaremos con Composer, el manejador de dependencias para PHP, las dependencias definidos en el archivo composer.json. Para ello abriremos una terminal en la carpeta del proyecto y ejecutaremos.

```
$ composer install

```
Vemos cómo se ha creado la carpeta vendor.

También debemos instalar las dependencias de NPM definidas en el archivo package.json con

```
$ npm install

```

## Crear una base de datos que soporte Laravel

Crear la base de datos en mysql, tendrás que configurar algún dato más en el .env relativo a esto, por ejemplo el puerto y el tipo de conexión.

##  Crear el archivo .env

Este archivo es necesario para, entre otras cosas, configurar la conexión de la bbdd, el entorno del proyecto, motores para envio y recepción de correos etc …
Como por cuestiones de seguridad tampoco se subió, necesitamos crearlo.
Podemos duplicar el archivo .env.example, renombrarlo a .env e incluir los datos de conexión de la base de datos que indicamos en el paso anterior.

## Generar una clave

La clave de aplicación es una cadena aleatoria almacenada en la clave APP_KEY dentro del archivo .env. Notarás que también falta.
Para crear la nueva clave e insertarla automáticamente en el .env, ejecutaremos:

```
$ php artisan key:generate

```

## Ejecutar migraciones

Por último, ejecutamos las migraciones para que se generen las tablas con:

```
$ php artisan migrate 

```
Con esto ya tendría que correr sin problemas la aplicación de Laravel que hemos clonado.

____

Imagenes 🚀

<a href="https://ibb.co/qCR1Twv"><img src="https://i.ibb.co/hcK83vS/Sin-t-tulo.png" alt="Sin-t-tulo" border="0"></a>
                                                                                                               
<a href="https://ibb.co/j5wnmXL"><img src="https://i.ibb.co/59jbmH5/7.png" alt="7" border="0"></a>
                                                                                                               
<a href="https://ibb.co/dGX1c0d"><img src="https://i.ibb.co/6gGVZR3/2.png" alt="2" border="0"></a>

<a href="https://ibb.co/HDJ9hHM"><img src="https://i.ibb.co/SXLZf31/3.png" alt="3" border="0"></a>
                                                                                             
<a href="https://ibb.co/jg70c3c"><img src="https://i.ibb.co/t8yj7Y7/5.png" alt="5" border="0"></a>
                                                                                             
<a href="https://ibb.co/dJ6kHyB"><img src="https://i.ibb.co/G3kCrj7/6.png" alt="6" border="0"></a>
____

# Autores ✒️

Gauna, Angel Guillermo  - Trabajo Inicial

____

Licencia 📄

Este proyecto es propiedad de grupo DHS, cualquier uso debera ser autorizado por dicha compañia.
____

⌨️ con ❤️ por <a href="https://github.com/gzangel19"> GZANGEL19 </a> 😊
