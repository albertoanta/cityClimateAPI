# Guide to install the test app

This is a code test for  **Eltiempo.es**

1. Download the repository
2. Rename the folder (Optional)
3. Enter the folder from the terminal `cd directory/of/the/folder`
4. Copy the contents of the `.env.example` file to a new file called `.env`
    * If you are on Liunx or Mac you can run the command: `cp .env.example .env`

5. Case SqlLite driver used for Database 
    `mkdir /tmp/database/`
    `touch /tmp/database/database.sqlite`
    
    Edit .env file to use created database
    
    See more datail at cityClimateAPI/.env.example
    DB_CONNECTION=sqlite
    DB_DATABASE=/tmp/database/database.sqlite


6. Case MySQL driver used for Database 
    Database creation MySQL (Case SQlLite not created)
   
    MySQL CLI authentication , can use any GUI db management tool such as "dbeaver"
    `sudo mysql -u root `

    MYSQL CLI database creation
    mysql> create database eltiempoESexercise;

    at this pipoint MySQL database eltiempoESexcercise is created and now Laravel can perform CRUD ops on it.

    Edit .env file to use created database
    See more datail at cityClimateAPI/.env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=eltiempoESexercise
    DB_USERNAME={usuario con permisos escritura acceso a la bbdd}
    DB_PASSWORD={passwd usuario}


8. Run `composer install`
9. Run `php artisan key:generate`

10. Default laravel Migration execute command
    cityClimateAPI$ `php artisan migrate`

    See more detail at database/migrations/2022_04_19_111013_create_cities_table.php

11. Execute Seeder for Cities Table
    cityClimateAPI$ `php artisan db:seed --class=CreateCitiesSeeder`
12. Execute php server on localhost port:8000
    `php artisan" serve --host='localhost' --port='8000'`

  
13. Open the app in the browser at port 8000 http://localhost:8000

# URL Examples for postman or web browser api requests

http://localhost:8000/api/cities?orderby=id&token=my-secret-token
http://localhost:8000/api/cities?orderby=name&token=my-secret-token
http://localhost:8000/api/cities&token=my-secret-token

http://localhost:8000/api/cities/ESCT0001/forecast/?token=my-secret-token 
Devuelve forecast para 5 días

http://localhost:8000/api/cities/ESCT0001/forecast/3?token=my-secret-token
Devuelve forecast para 3 días 



# System requirements
*  mysql Server or sqllite driver
# PHP Modules requirements
   * php-curl
   * php-pdo
   * mysql or sqldriver module for php
   * composer 
    
   
   