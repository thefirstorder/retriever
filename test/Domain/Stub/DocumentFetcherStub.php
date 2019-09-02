<?php
declare(strict_types=1);

namespace Retriever\Domain\Stub;

use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\FetchedDocument;

class DocumentFetcherStub implements DocumentFetcher
{
    /** @var FetchedDocument */
    private $document;

    private function __construct(FetchedDocument $document)
    {
        $this->document = $document;
    }

    public static function makeStub($document = null): DocumentFetcher
    {
        return new self($document ?? FetchedDocumentStub::single());
    }

    public function fetchDocument(DocumentRequest $document): FetchedDocument
    {
        return $this->document;
    }
}
