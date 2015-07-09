# APIRestWithSilex
Example for APIRest with Silex
## Requisitos
* composer
* git (sudo apt-get install git) ubuntu
* curl (sudo apt-get install curl) ubuntu
* php5.5, php5-clic 
* mysql

## Composer
[Tutotial en español](https://librosweb.es/libro/composer/capitulo_1.html) <br/>
[Sitio oficial](https://getcomposer.org/doc/00-intro.md)

## ¿Como iniciar?
1. git clone https://github.com/roberto-slopez/APIRestWithSilex.git
2. Ubicarse en el directorio donde se hizo el clone en la terminal, ejemplo cd /home/user/projects/APIRestWithSilex/
3. Ejecutar composer: composer up (global) composer.phar up (local)
4. Crear tabla: APIRestWithSilex/TS/table.sql
5. Configurar conexion APIRestWithSilex/TS/app.php lineas=10:12
6. Levantar server: php -S localhost:8080 -t web web/index.php

## Agregar registros
<code>
 curl --data "code=20&name=test&quantity=20&description=texto&image=texto" http://localhost:8080
</code>

## Obtener todos los registros
<code>
curl -i -H "Accept: application/json" -H "Content-Type: application/json" -X GET http://localhost:8080 
</code>

## Obtener por codigo
- reemplazar codigo por el numero que representa el codigo del registro. <br/>
<code>
curl -X GET http://localhost:8080/codigo
</code>

## Eliminar registro
- reemplazar codigo por el numero que representa el codigo del registro. <br/>
<code>
curl -X 'DELETE http://localhost:8080/codigo'
</code>

## Notas

* Deje el dump de la db si lo desean usar (dumpDB.sql)
* [Silex Home](http://silex.sensiolabs.org/)
* [Idiorm Docs](http://idiorm.readthedocs.org/en/latest/index.html)
