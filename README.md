# Plus-Assessment

#### A simple crud project for creating and updating users. This project makes use of a simple implementation for roles and permission.

#### By Sean Malebana

## Technologies Used

* Laravel 8
* Scss
* Jquery
* javascript

## Description

_{This is a detailed description of your application. Give as much detail as needed to explain what the application does as well as any other information you want users or other developers to have.}_

## Setup/Installation Requirements

* step 1: run ```composer install``` upon doing a git clone
* step 2: copy the .env.example and rename it to .env
* step 3: within the .env file is where you can setup your various app feature but he most important are:
    
    ```
    ================= For Securing sessions, cookies, etc. run =================
     php artisan key:generate
     ===========================================================================
     
    ================= Database Setup ===========================================
    NB: setup your database and configure the env variables below
    ============================================================================
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    
    ================= Database Setup =================
    NB: This app requires a working mail service.
    
    For local testing you can use https://github.com/mailhog/MailHog
    ==================================================
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=null
    ```
* finally run ```php artisan migrate:fresh --seed```. This command is used just in case your database already has conflicting data.
* enjoy!!
