docker-run = docker-compose run --rm
cli = $(docker-run) cli

list:
	$(cli) bin/retriever list

retrieve:
	$(cli) bin/retriever retrieve $(uri)
