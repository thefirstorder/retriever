<?php
declare(strict_types=1);

namespace Retriever\Domain;

interface DocumentStorage
{
    public function store(FetchedDocument $document): void;
}
