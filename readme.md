<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## Instalacion en entorno de desarrollo

<ul>
	<li>-Descargar el archivo .env y ponerlo en la carpeta raiz del proyecto</li>
	<li>Abrir terminal o consola en raiz del proyecto</li>
	<li>Crear una base de datos vacia en el SGBD Mysql del equipo con el nombre: remu_sw2018</li>
	<li>Ejecutar comando: php artisan migrate. Este creara la tablas necesarias en la base de datos</li>
	<li>Ejecutar comando: php artisan db:seed. Este insertara datos necesarios en las tablas correspondientes</li>
	<li>Ejecutar comando: php artisan serve. Y listo.</li>
</ul>

## Sobre el Proyecto

Este proyecto es parte del ramo Taller de Ingeniería de Software 2018. A continuación una pequeña reseña:

Altavida es una organización la cual entrega un servicio a niños que requieren una
enseñanza especializada, actualmente consta con un amplio grupo de trabajadores que
cumplen distintos roles dentro de esta. Dado a la trayectoria de la organización y al
aumento del personal, se haya la necesidad de automatizar ciertos procesos. Uno de los
principales problemas es el registro de ingreso y salida de los trabajadores y cálculo de
las horas trabajadas. Es por ello que existe una creciente necesidad de automatizar este
proceso y crear un sistema adecuado para solucionar el problema y ayudar a la gestión de
las horas trabajadas de cada funcionario.
El sistema está contemplado por ciertas restricciones inmersas en las reglas de negocio
de la organización, al igual que se busca implementar un sistema de registro de entrada y
salida acorde a la época actual, que es el lector dactilar. Esta herramienta busca agilizar
tanto el proceso de registro de entrada o salida de los trabajadores como el sistema de
remuneración actual sujeto a las distintas restricciones de la organización. A continuación
se describirán con mayor detalle todos los elementos necesarios para llevar a cabo el sistema
y se entrará más a fondo a la propuesta para solucionar este problema.

## Integrantes del Proyecto

- Alejandro Arancibia @amphen4
- Alexis Flores
- Daniel Ojeda
- Oscar Sepulveda @___sepulveda

## Licencia

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
