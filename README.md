![alt text](https://github.com/sangib58/Inertia-Admin/blob/main/public/images/github-read-me-image.png)

# Short Description

This is an Admin Template build on Inertia 3. I used Laravel 12 and Vue 3 composition Api to build this project. You can use this template as a boilerplate of your next inertia project. I tried to cover all basic things to kick off a new project.

# Requirements

-   Visual Studio Code (prefered)/Any other IDE.
-   Node 20
-   Php 8
-   Laravel 12
-   Database provider software (MySql 8.4).

# Instruction to Run

Change database related config on .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inertiadmin
DB_USERNAME=root
DB_PASSWORD=Root@1234

Then on console of root directory of the project run below commands,

-   npm install
-   php artisan app:migrate-with-database
-   npm run dev
-   php artisan serve
