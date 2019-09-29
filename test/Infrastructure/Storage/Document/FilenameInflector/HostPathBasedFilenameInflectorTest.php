<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document\FilenameInflector;

use PHPUnit\Framework\TestCase;
use Retriever\Domain\BaseFetchedDocument;
use Retriever\Domain\Exception\RetrieverException;
use Retriever\Infrastructure\Storage\Document\FilenameInflector;

class HostPathBasedFilenameInflectorTest extends TestCase
{
    /** @var FilenameInflector */
    private $inflector;

    public function setUp(): void
    {
        $this->inflector = new HostPathBasedFilenameInflector();
    }

    public function test_it_throws_exception_if_host_metadata_not_found()
    {
        $this->expectException(RetrieverException::class);

        $fetchedDocument = $this->buildFetchedDocumentStub();

        $this->inflector->inflect($fetchedDocument);
    }

    public function test_it_returns_unknown_domain_if_metadata_has_no_host()
    {
        $fetchedDocument = $this->buildFetchedDocumentStub('/path-only');

        $filename = $this->inflector->inflect($fetchedDocument);

        $this->assertEquals('unknown.domain/path-only', $filename);
    }

    public function test_it_returns_original_domain_if_metadata_has_domain()
    {
        $fetchedDocument = $this->buildFetchedDocumentStub('http://bricklink.com/path-only');

        $filename = $this->inflector->inflect($fetchedDocument);

        $this->assertEquals('bricklink.com/path-only', $filename);
    }

    /**
     * @dataProvider validHostsWithoutPathDataProvider
     */
    public function test_it_returns_index_html_when_host_has_no_path(string $hostWithoutPath)
    {
        $fetchedDocument = $this->buildFetchedDocumentStub($hostWithoutPath);

        $filename = $this->inflector->inflect($fetchedDocument);

        $this->assertEquals('bricklink.com/index.html', $filename);
    }

    public function validHostsWithoutPathDataProvider()
    {
        return [
            ['http://bricklink.com'],
            ['http://bricklink.com/'],
            ['http://bricklink.com?'],
        ];
    }

    /**
     * @dataProvider validHostsWithQueryDataProvider
     */
    public function test_it_adds_query_information_when_host_includes_a_query(string $hostWithQuery, string $expected)
    {
        $fetchedDocument = $this->buildFetchedDocumentStub($hostWithQuery);

        $filename = $this->inflector->inflect($fetchedDocument);

        $this->assertEquals($expected, $filename);
    }

    public function validHostsWithQueryDataProvider()
    {
        return [
            ['/?var=value', 'unknown.domain/index.html-var=value'],
            ['https://domain.com/?var=value', 'domain.com/index.html-var=value'],
            ['/?var=value&var2=value2', 'unknown.domain/index.html-var=value-var2=value2'],
        ];
    }

    private function buildFetchedDocumentStub(string $host = null)
    {
        return new BaseFetchedDocument(
            'http://www.bricklink.com',
            'Document content',
            $host == null ? [] :
            [
                'Host' => $host
            ]
        );
    }
}
