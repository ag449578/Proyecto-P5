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
4. `symfony console make:migration` : Crea el archivo de migracion de las entidades.
5. `symfony console doctrine:migrations:migrate` : Aplica las migraciones.
6. `symfony console app:create-admin Admin admin@admin.com 123456` : Crea un usuario tipo administrador.
    * `symfony console app:create-admin --help` : Para ver las opciones.
7. `symfony server:start` : Inicia el servidor.

