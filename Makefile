.PHONY: test

docker-run = docker-compose run --rm
cli = $(docker-run) cli

install:
	$(cli) composer install

bash:
	$(cli) bash

test:
	$(cli) vendor/bin/phpunit test

retrieve:
	$(cli) bin/retriever retrieve $(uri)

retrieve-metadata:
	$(cli) bin/retriever retrieve $(uri) --include-metadata