<?php

declare(strict_types=1);

namespace Retriever\Application;

use Exception;
use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentFetcherFactory;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\DocumentStorage;
use Retriever\Domain\FetchedDocument;
use Retriever\Domain\Exception\DocumentFetcherException;
use Retriever\Domain\Exception\RetrieverException;

class Retriever
{
    /** @var DocumentFetcher */
    private $fetcherFactory;

    /** @var DocumentStorage */
    private $storage;

    public function __construct(
        DocumentFetcherFactory $documentFetcherFactory,
        DocumentStorage $storage
    ) {
        $this->fetcherFactory = $documentFetcherFactory;
        $this->storage = $storage;
    }

    public function retrieve(DocumentRequest $request): FetchedDocument
    {
        try {
            $fetcher = $this->fetcherFactory->buildForDocumentRequest($request);
            $fetchedDocument = $fetcher->fetchDocument($request);
            $this->storage->store($fetchedDocument);

            return $fetchedDocument;
        } catch (DocumentFetcherException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new RetrieverException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
