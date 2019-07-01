<?php
declare(strict_types=1);

namespace Retriever\Domain\Exception;

class DocumentRequestException extends RetrieverException
{
    public static function invalidDocumentHandler(string $handler): RetrieverException
    {
        $e = new self('The specified handler is invalid.');
        $e->related = $handler;
    }
}