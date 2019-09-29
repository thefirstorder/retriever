<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Exception;

use Retriever\Domain\Exception\RetrieverException;

class CantStoreFileException extends RetrieverException
{
    static public function becauseItAlreadyExists(string $filename)
    {
        return new self("Can't store the document at $filename because that file already exists");
    }
}
