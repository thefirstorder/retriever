<?php
declare(strict_types=1);

namespace Retriever\Domain;

interface DocumentFetcherFactory
{
    public function buildForDocumentRequest(DocumentRequest $request): DocumentFetcher;
}
