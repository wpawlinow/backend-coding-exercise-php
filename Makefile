run-custom:
	docker-compose exec -T app bin/console app:search $(filename) $(day) $(time) $(location) $(covers)

run-valid:
	docker-compose exec -T app bin/console app:search 'resources/input.ebnf' '23/07/2018' '16:30' 'G58 1SB' 15

run-invalid:
	docker-compose exec -T app bin/console app:search 'resources/input.ebnf' '2307/2018' '16:310' 'G58]1SB' 15

test:
	docker-compose exec -T app phpunit
