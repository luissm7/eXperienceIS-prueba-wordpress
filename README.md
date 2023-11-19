# Prueba técnica Experience IT

## Comment

Para realizar este prueba he creado un plugin con el nombre `Search Ajax`.

En este plugin cuando lo activas por primera vez te crea un Custom Post Type `Usuarios` donde añado a traves del endpoint POST creado `add_users` 20 usuarios.

También he creado un shortcode para poder mostrar la tabla con el buscador Ajax.

Toda la funcionalidad se encuentra en el fichero `search-ajax.php` dentro de la carpeta del módulo.

## Installation

### Repository

Clone this repository.

Execute

    docker-compose up

In docker container php `sudo docker exec -it experienceprueba_php /bin/bash`

    composer install

### Virtual host

    sudo nano /etc/hosts
    127.0.0.1    experienceprueba.docker.localhost

### BBDD

Import your database from docker container php using wp-cli:

    cd web/
    wp db import bbdd-prueba-tecnica-experienceIT.sql

### Create administrator user

Create a user with

    wp user create myusername myusername@example.com --role=administrator




Wordpress is located under `web/` folder.
