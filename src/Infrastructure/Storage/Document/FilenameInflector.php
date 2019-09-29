<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document;

use Retriever\Domain\FetchedDocument;

interface FilenameInflector
{
    public function inflect(FetchedDocument $document): string;
}
