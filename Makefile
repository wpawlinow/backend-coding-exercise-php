build:
	docker-compose up -d --build
	docker-compose exec -T app bin/console doctrine:database:create
	docker-compose exec -T app bin/console doctrine:schema:create
	docker-compose exec -T app bin/console doctrine:schema:update

run-custom:
	docker-compose exec -T app bin/console app:search $(filename) $(day) $(time) $(location) $(covers)

run-valid:
	docker-compose exec -T app bin/console app:search 'resources/input.ebnf' '11/11/18' '11:00' 'NW42QA' 20

run-invalid:
	docker-compose exec -T app bin/console app:search 'resources/input.ebnf' '2307/2018' '16:310' 'G58]1SB' 15

test:
	docker-compose exec -T app phpunit
