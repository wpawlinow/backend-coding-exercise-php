# CityPantry test project - solution
Author: **Wojciech Pawlinów**  
Stack: **Dockerized Symfony 4 CLI application + SQLite**

0. ` cp .env.dist .env && phpunit.xml.dist phpunit.xml`

build:
	docker-compose build
	docker-compose up -d --force-recreate
	docker-compose exec -T php_app bin/console doctrine:database:create
	docker-compose exec -T php_app bin/console doctrine:schema:create
	docker-compose exec -T php_app bin/console doctrine:schema:update --force
1. `docker-compose build && docker-compose up -d`
2. `docker exec -it php_app bash `
3. `composer install`
4. `docker exec -it php_app bin/console doctrine:database:create`
5. `docker exec -it php_app bin/console doctrine:schema:create`  
`docker exec -it php_app bin/console doctrine:schema:update --force`

Run  
`make run-valid`

### Description
- App is in Docker with Nginx and PHP 7.2 
- Used Symfony 4 Console component to build CLI app
- There is a Makefile to run already prepared commands
- I used my own idea how I'd split this application on domains. This is my concept I like to modeling systems 
- Used Command bus pattern to handle some actions and to keep 'request data' as an object - easily testable and helpful solution
- Used Dependency Injection and Symfony autowiring
- Used Events Dispatcher (might not be very useful in code, but it's more like PoC how I like to react on actions in the system) - registered as a subscriber instead of listeners
- Used compositional approach over the inheritance when creating dependencies like Repository for persistence
- Used ValueObjects
- Used fluent setters to let me chain objects methods
- Tried to follow SRP and KISS
- I kept my code well formatted without any external code sniffers
- Used type-hints
- Used Doctrine and SQLite driver to keep data in file and follow CSQR - thus I could code Command Bus which basically make the only one thin (command) that does not return any data.
- I wrote simple tests for Command using CommandTester and I have not manage to write any more

Running this command gives no output, as the query to search is missing.
