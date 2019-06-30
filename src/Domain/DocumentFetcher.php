<?php
declare(strict_types=1);

namespace Retriever\Domain;

interface DocumentFetcher
{
    public function fetchDocument(DocumentRequest $document): FetchedDocument;
}
