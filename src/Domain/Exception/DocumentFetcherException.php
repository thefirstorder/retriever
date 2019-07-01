<?php
declare(strict_types=1);

namespace Retriever\Domain\Exception;

use Retriever\Domain\DocumentRequest;

class DocumentFetcherException extends RetrieverException
{
    public static function doesNotExistForDocumentRequest(DocumentRequest $request): DocumentFetcherException
    {
        $e = new self('I couldn\'t find a Document Fetcher for the requested Document');
        $e->related = $request;

        return $e;
    }
}
