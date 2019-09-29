<?php
declare(strict_types=1);

namespace Retriever\Domain\Stub;

use Retriever\Domain\BaseDocumentRequest;
use Retriever\Domain\DocumentRequest;

class DocumentRequestStub
{
    public static function single(): DocumentRequest
    {
        return new BaseDocumentRequest(
            'http://example.com/document',
            'test'
        );
    }
}
