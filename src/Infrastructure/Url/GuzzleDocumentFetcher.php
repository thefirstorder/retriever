<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Url;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Retriever\Domain\BaseFetchedDocument;
use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\Exception\DocumentFetcherException;
use Retriever\Domain\FetchedDocument;

class GuzzleDocumentFetcher implements DocumentFetcher
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchDocument(DocumentRequest $document): FetchedDocument
    {
        try {
            $response = $this->client->request('GET', $document->getDocumentHandler());

            return new BaseFetchedDocument(
                $document->getDocumentHandler(),
                $response->getBody()->getContents(),
                $response->getHeaders() + [
                    'Host' => [$document->getDocumentHandler()]
                ]
            );

        } catch (TransferException $e) {
            throw DocumentFetcherException::doesNotExistForDocumentRequest($document, $e);
        }
    }
}
