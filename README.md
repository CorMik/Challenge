# Cooding Challenge

##  How to run?
This project I built with docker in mind so if you don't have it you can get it here:

https://docs.docker.com/docker-for-mac/install/

Once you have docker installed and you've cloned this repo you can run

    $ make
 This will do all that is required to set up the application including creating three docker containers 
- nginx
- mysql
- php

## The Make Command   


The Make command uses docker compose and creates a network called challenge.

The make command runs:

    $ cp src/.env.example src/.env
To copy over .env so you can then add any additional secrets.

Then it runs:

    $ docker-compose build && docker-compose up -d
    
This builds the new docker containers based of the docker-compose.yml file then starts them.

Once that complete the make command then will run: 

    $ docker exec -it app composer install

This runs composer install inside the app docker container. This allows you to use this application without having composer installed on your machine.

Then it runs some laravel artisan commands which set up the database and then runs the offers import cron job to get all the offers I have hosted form the json file

    $ docker exec -it app php artisan migrate
    $ docker exec -it app php artisan offers:get

## Take it down?

So, now you want to take it down? well simply run:

    $ docker-compose down
    
WARNING make sure you do this in the procect root.

## What I did?

I built the application based on the full stack specifications.

I used Laravel as my framework to help easily build keeping MVC in mind. 

For the frontend I used Vue js and vanilla Javascript simply to help render the data I would receive from my backend api.

You can get all offers by hitting:

    GET "/api/offers
    
Which also accept pre-defined query parameters to help sort the application.


My application uses the following layers

- Controller
- Models
- Services
- Repositories
- Views

I also created the Offers import with the idea of it being a cron job that will run daily to get any new offers.

## Tests?

 Yes I've created some unit tests! You can run this by navigating to the src folder and running:
 
    $ ./vendor/bin/phpunit
    
    
## Thank you!

I look forward to hearing your feed back

## Docker didnt work?
if docker didn't work there is laravel instruction to run the application locally in src/README.md