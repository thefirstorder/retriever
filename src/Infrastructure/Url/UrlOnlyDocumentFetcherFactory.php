<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Url;

use GuzzleHttp\Client;
use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentFetcherFactory;
use Retriever\Domain\DocumentRequest;

class UrlOnlyDocumentFetcherFactory implements DocumentFetcherFactory
{
    public function buildForDocumentRequest(DocumentRequest $request): DocumentFetcher
    {
        return new GuzzleDocumentFetcher(new Client());
    }
}
