# scripts_php_llamafiles

Pequeño proyecto desarrollado bajo PHP en el cual se hace uso de una API de RapidAPI para obtener información sobre productos y reseñas de Amazon.

Tanto los productos como las reseñas son almacenados en la BD para su posterior analisis por el modelo llava-v1.5-7b-q4.


## Tabla de Contenidos

- [Instalación](#instalación)
- [Uso](#uso)

## Instalación

> **Requires [PHP 8.1+](https://php.net/releases/)**
> **Requires [Docker](https://docs.docker.com/get-docker/)**
> **Requires [Lando](https://docs.lando.dev/install)**

Creamos el entorno de desarrollo con Lando ejecutando el siguiente comando en la carpeta del proyecto:
```bash
lando start
```

Instalamos las dependencias requeridas:
```bash
composer install
```

Por ultimo ejecutaremos el comando proporcionado a continuación para obtener la información de conexión a nuestra BD y utilizaremos un cliente de nuestra elección para insertar las tablas requeridas para el correcto funcionamiento de la aplicación proporcionadas en el archivo db_tables.sql
```bash
lando info
```

## Uso

Accedemos al servidor web proporcionado al ejecutar lando, se nos presenta una pantalla de inicio en la cual podemos introducir el ASIN de un producto de Amazon.
Al cargar el producto este se guarda automaticamente en la BD junto con 10 de sus reseñas y se le muestra al usuario en la pantalla principal.
Podemos pulsar el boton inspeccionar para ver los datos de un producto guardado junto con sus reseñas, ademas en esta pantalla el usuario es capaz de introducir el numero de reseñas que desea analizar.
Al introducir un numero de reseñas a analizar estas son analizadas por el modelo llava-v1.5-7b-q4 en busca de dictaminar si son reseñas positivas o negativas acerca del producto.

## Estado del Proyecto

El proyecto se encuentra actualmente en desarrollo..