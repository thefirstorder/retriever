<?php
declare(strict_types=1);

namespace Retriever\Domain\Exception;

use PHPUnit\Framework\TestCase;
use Retriever\Domain\DocumentRequest;

class DocumentFetcherExceptionTest extends TestCase
{
    public function test_it_exposes_the_related_document_when_available()
    {
        $mockRequestDocument = $this->prophesize(DocumentRequest::class);
        $mockRequestDocument->getDocumentType()->willReturn('invalid');

        $exception = DocumentFetcherException::doesNotExistForDocumentRequest($mockRequestDocument->reveal());

        $this->assertSame($mockRequestDocument->reveal(), $exception->getRelated());
    }
}
