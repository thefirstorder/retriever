<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Url;

use PHPUnit\Framework\TestCase;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\Exception\DocumentFetcherException;

class UrlOnlyDocumentFetcherFactoryTest extends TestCase
{
    public function test_it_should_throw_exception_when_DocumentType_is_not_Url()
    {
        $this->expectException(DocumentFetcherException::class);

        $request = $this->prophesize(DocumentRequest::class);
        $request->getDocumentType()->willReturn('database');

        $factory = new UrlOnlyDocumentFetcherFactory();

        $factory->buildForDocumentRequest($request->reveal());
    }
}
