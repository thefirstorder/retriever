# Retriever
Resource scrapper

### Installation
`docker-compose run --rm cli composer install`

### Usage
The basic usage of the `retriever` console command is with the 
`retrieve` action that expects an url to fetch:
 
`docker-compose run --rm cli bin/retriever retrieve http://google.com`

You could ask `Retriever` to actually include the Document Metadata 
on top of the content, with the flag `--include-metadata`.

A simple way to save the content for now is to redirect the output to 
a file:

`docker-compose run --rm cli bin/retriever retrieve http://google.com --include-metadata > google.com.txt`

### Up And Running
`docker-compose up`

### Para loguearse en la terminal del container
`docker-compose run cli /bin/bash`

### Para correr los tests
`docker-compose run cli phpunit test`