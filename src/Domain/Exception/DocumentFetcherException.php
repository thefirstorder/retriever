<?php
declare(strict_types=1);

namespace Retriever\Domain\Exception;

use PHPUnit\Exception;
use Retriever\Domain\DocumentRequest;

class DocumentFetcherException extends RetrieverException
{
    public static function doesNotExistForDocumentRequest(DocumentRequest $request): DocumentFetcherException
    {
        $e = new self('I couldn\'t find a Document Fetcher for the requested Document');
        $e->related = $request;

        return $e;
    }

    public static function documentCouldNotBeRetrieved(
        DocumentRequest $document,
        Exception $previousException = null
    ): DocumentFetcherException {
        $e = new self(
            'The Requested Document could not be fetched by the DocumentFetcher',
            null,
            $previousException
        );
        $e->related = $document;

        return $e;
    }
}
