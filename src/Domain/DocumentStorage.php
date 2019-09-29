<?php
declare(strict_types=1);

namespace Retriever\Domain;

use Retriever\Domain\Exception\DocumentFetcherException;

interface DocumentStorage
{
    /**
     * @param FetchedDocument $document
     * @throws DocumentFetcherException
     */
    public function store(FetchedDocument $document): void;
}
