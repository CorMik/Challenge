# Laravel specfic instructions

If the docker set up didn't work here's the laravel set up.
first thing is to create your .env using the .env.example

    $ cp .env.example .env
    
Now that you've completed that time to update your env variable for your DB

    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    
This should be updated with credentials from an empty local database hosted with mysql.server.

Now it's time to install composer:

    $ composer install

Once that is done you should be ready to run your migrations:

    $ php artisan migrate
    
Now time to populate your database:

    $ php artisan offers:get
    
Once that is done you should be ready to run your server

    $ php artisan serve


Now you should be able to go to the url provided and use the application.
    
