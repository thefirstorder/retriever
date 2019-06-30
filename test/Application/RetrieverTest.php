<?php
declare(strict_types=1);

namespace Retriever\Application;

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Exception;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Retriever\Domain\DocumentFetcher;
use Retriever\Domain\DocumentFetcherFactory;
use Retriever\Domain\DocumentRequest;
use Retriever\Domain\Exception\DocumentFetcherException;
use Retriever\Domain\Exception\RetrieverException;

class RetrieverTest extends TestCase
{
    /** @var Retriever */
    private $retriever;

    /** @var DocumentFetcherFactory */
    private $factory;

    public function setUp(): void
    {
        $this->factory = $this->prophesize(DocumentFetcherFactory::class);
        $this->retriever = new Retriever($this->factory->reveal());
    }

    public function test_it_throws_valid_exception_when_cant_get_a_fetcher()
    {
        $this->expectException(DocumentFetcherException::class);

        $mockRequest = $this->getMockDocumentRequest();

        $this->factory->buildForDocumentRequest(Argument::any())->willThrow(
            DocumentFetcherException::doesNotExistForDocumentRequest($mockRequest->reveal())
        );

        $this->retriever->retrieve($mockRequest->reveal());
    }

    public function test_it_throws_generic_expception_if_something_else_fails()
    {
        $this->expectException(RetrieverException::class);

        $mockRequest = $this->getMockDocumentRequest();
        $mockFetcher = $this->prophesize(DocumentFetcher::class);
        $mockFetcher->fetchDocument($mockRequest->reveal())->willThrow(
            new Exception("Something weird happened", 1000)
        );
        $this->factory->buildForDocumentRequest(Argument::any())->willReturn($mockFetcher->reveal());

        $this->retriever->retrieve($mockRequest->reveal());
    }

    /**
     * @return ObjectProphecy
     */
    private function getMockDocumentRequest(): ObjectProphecy
    {
        $mockRequest = $this->prophesize(DocumentRequest::class);
        $mockRequest->getDocumentType()->willReturn('invalid');
        return $mockRequest;
    }

}
