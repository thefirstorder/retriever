<?php
declare(strict_types=1);

namespace Retriever\Domain\DocumentRequest;

use PHPUnit\Framework\TestCase;
use Retriever\Domain\Exception\DocumentRequestException;

class UrlDocumentRequestTest extends TestCase
{
    public function test_it_throws_exception_for_invalid_url()
    {
        $this->expectException(DocumentRequestException::class);

        (new UrlDocumentRequest('this is not an Url'));
    }
}
