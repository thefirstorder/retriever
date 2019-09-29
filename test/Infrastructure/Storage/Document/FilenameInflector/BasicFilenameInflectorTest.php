<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document\FilenameInflector;

use PHPUnit\Framework\TestCase;
use Retriever\Domain\BaseFetchedDocument;

class BasicFilenameInflectorTest extends TestCase
{
    public function test_it_inflects_filename_based_on_handler()
    {
        $document = new BaseFetchedDocument(
            'filename.txt',
            'fileContents'
        );

        $filename = (new BasicFilenameInflector())->inflect($document);

        $this->assertEquals($filename, 'filename.txt');
    }
}
