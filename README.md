# Retriever
Resource scrapper

### Installation
`make install`

### Usage
The basic usage of the `retriever` console command is with the 
`retrieve` action that expects an url to fetch:
 
`make retrieve uri=http://google.com`

You could ask `Retriever` to actually include the Document Metadata 
on top of the content, with the make targe `retrieve-metadata`.

A simple way to save the content for now is to redirect the output to 
a file:

`make retrieve-metadata uri=http://google.com > google.com.txt`

### To Login on container Terminal
`make bash`

### Running tests
`make test`