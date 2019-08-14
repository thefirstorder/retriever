<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Url;

use GuzzleHttp\Client;
use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentFetcherFactory;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\DocumentRequest\UrlDocumentRequest;
use Retriever\Domain\Exception\DocumentFetcherException;

class UrlOnlyDocumentFetcherFactory implements DocumentFetcherFactory
{
    public function buildForDocumentRequest(DocumentRequest $request): DocumentFetcher
    {
        if ($request->getDocumentType() !== UrlDocumentRequest::TYPE)
        {
            throw DocumentFetcherException::doesNotExistForDocumentRequest($request);
        }

        return new GuzzleDocumentFetcher(new Client());
    }
}
