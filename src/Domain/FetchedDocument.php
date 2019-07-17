<?php
declare(strict_types=1);

namespace Retriever\Domain;

use ArrayIterator;

interface FetchedDocument
{
    public function getDocumentHandler(): string;
    public function getDocumentContent(): string;
    public function getMetadata(): ArrayIterator;
}
