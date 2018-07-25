build:
	docker exec -it php_app bin/console doctrine:database:create
	docker exec -it php_app bin/console doctrine:schema:create
	docker exec -it php_app bin/console doctrine:schema:update --force

run-custom:
	docker exec -it php_app bin/console doctrine:schema:drop --force
	docker exec -it php_app bin/console doctrine:schema:create
	docker exec -it php_app bin/console app:search $(filename) $(day) $(time) $(location) $(covers)

run-valid:
	docker exec -it php_app bin/console doctrine:schema:drop --force
	docker exec -it php_app bin/console doctrine:schema:create
	docker exec -it php_app bin/console app:search 'resources/input.ebnf' '11/11/18' '11:00' 'NW42QA' 20

run-invalid:
	docker exec -it php_app bin/console doctrine:schema:drop --force
	docker exec -it php_app bin/console doctrine:schema:create
	docker exec -it php_app bin/console app:search 'resources/input.ebnf' '2307/2018' '16:310' 'G58]1SB' 15

test:
	docker exec -it app phpunit
