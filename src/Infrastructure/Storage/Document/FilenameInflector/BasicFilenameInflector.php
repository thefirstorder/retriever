<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document\FilenameInflector;

use Retriever\Domain\FetchedDocument;
use Retriever\Infrastructure\Storage\Document\FilenameInflector;

class BasicFilenameInflector implements FilenameInflector
{
    public function inflect(FetchedDocument $document): string
    {
        return (string) $document->getDocumentHandler();
    }
}
