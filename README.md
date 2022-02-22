# Sistema de gestion de contenidos academicos

## Requerimientos:
1. Debe tener instalado php, composer, symfony-cli, node^14.

## Configuraciones:
1. En el archivo *.env* debe configurar los parametros de configuracion de la base de datos:
    * DATABASE_URL="mysql://username:passw@127.0.0.1:3306/db_name?serverVersion=5.7"

## Instalación:

1. `composer install`: Instala las dependencias de php.
2. `npm install` : Instala las dependencias de node.
3. `npm run dev` : Compila los archivos con webpack.
4. `symfony console make:migrations` : Crea el archivo de migracion de las entidades.
5. `symfony console doctrine:migrations:migrate` : Aplica las migraciones.
6. `symfony console app:create-admin Admin admin@admin.com 123456` : Crea un usuario tipo administrador.
    * `symfony console app:create-admin --help` : Para ver las opciones.
7. `symfony server:start` : Inicia el servidor.


### TODO:
1. Paginaciones en listado de usuarios y asignaturas. OK
2. Diseñar vista perfil de usuario. OK
3. Diseñar vista materiales(publica) OK
4. CRUD completo de usuarios. OK
5. Implementar subida de foto asignatura OK
6. Implementar Validaciones de los cruds. ~OK
7. Implementar filtro para rol listado usuarios. OK
8. Relacion Asignaturas_EStudiantes no funciona bien(en Easyadmin). OK verificado, funciona en los controladores.
9. CRUD completo de Contenidos OK (Las url no son funcionales aun)
10. Crud completo de contenidos
11. Crud completo de secciones
