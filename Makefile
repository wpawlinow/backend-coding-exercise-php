run-custom:
	docker-compose exec -T app bin/console app:search $(filename) $(day) $(time) $(location) $(covers)

run-example:
	docker-compose exec -T app bin/console app:search '../../resources/input.ebnf' '23/07/2018' '10:30' 'NW43QB' 15

test:
	docker-compose exec -T app phpunit
