<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Desarrollo de TODO - Creative

Documentación https://laravel.com/docs/5.8

## Requerimientos

- PHP > 7.1
- Git
- Composer


## Instalación

## Clonamos el repositorio

```
 $ git clone https://github.com/JeanMg26/creative_test.git
```

## Accedemos al directorio

```
 cd creative_test
```

## Ejecutamos el siguiente comando.

```
 composer install
```

## Creamos una base de datos con el nombre "creative"

## Modificamos el nombre del archivo .env.example. por .env y agregamos las credenciales para la conexion de la bd.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=creative
DB_USERNAME=root
DB_PASSWORD=
```

## Por ultimo solo debemos generar una key para nuestra API.

```
php artisan key:generate
```

## Ahora corremos las migraciones para crear las tablas en nuestra base de datos.

```
php artisan migrate
```

## Listo ya podemos ejecutar nuestra API.

```
php artisan serve
```
