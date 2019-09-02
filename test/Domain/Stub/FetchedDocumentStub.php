<?php
declare(strict_types=1);

namespace Retriever\Domain\Stub;

use Retriever\Domain\BaseFetchedDocument;
use Retriever\Domain\FetchedDocument;

class FetchedDocumentStub
{
    public static function single(): FetchedDocument
    {
        return new BaseFetchedDocument(
            'http://example.com/document',
            'Test Content',
            [
                'Host' => 'http://example.com/document'
            ]
        );
    }
}
