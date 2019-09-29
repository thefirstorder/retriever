<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document;

use League\Flysystem\Filesystem;
use League\Flysystem\Memory\MemoryAdapter;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Retriever\Domain\DocumentStorage;
use Retriever\Domain\FetchedDocument;
use Retriever\Domain\Stub\FetchedDocumentStub;
use Retriever\Infrastructure\Storage\Exception\CantStoreFileException;

class FileSystemDocumentStorageTest extends TestCase
{
    /** @var Filesystem */
    private $filesystem;

    /** @var FilenameInflector */
    private $inflector;

    /** @var DocumentStorage */
    private $storage;

    public function setUp(): void
    {
        $this->filesystem = new Filesystem(new MemoryAdapter());
        $this->inflector = $this->prophesize(FilenameInflector::class);
        $this->storage = new FileSystemDocumentStorage($this->filesystem, $this->inflector->reveal());
    }

    public function test_it_throws_exception_when_file_already_exists()
    {
        $this->expectException(CantStoreFileException::class);

        $existingFilename = './path/existingFile.txt';

        $this->filesystem->write($existingFilename, "file contents");

        $this->inflector
            ->inflect(Argument::type(FetchedDocument::class))
            ->willReturn($existingFilename);

        $this->storage->store(FetchedDocumentStub::single());
    }

    public function test_it_stores_the_file_if_overwrite_is_true()
    {
        $existingFilename = './path/existingFile.txt';

        $this->filesystem->write($existingFilename, "file contents");

        $this->inflector
            ->inflect(Argument::type(FetchedDocument::class))
            ->willReturn($existingFilename);

        $this->storage = new FileSystemDocumentStorage(
            $this->filesystem,
            $this->inflector->reveal(),
            true
        );
        $this->storage->store(FetchedDocumentStub::single());

        $this->assertEquals(<<<DOCUMENT
---
Host: 'http://example.com/document'
---
Test Content
DOCUMENT
            ,
            $this->filesystem->read($existingFilename)
        );
    }

    public function test_it_stores_the_file_if_it_does_not_exists()
    {
        $filename = './path/existingFile.txt';

        $this->inflector
            ->inflect(Argument::type(FetchedDocument::class))
            ->willReturn($filename);

        $this->storage->store(FetchedDocumentStub::single());

        $this->assertEquals(
            <<<DOCUMENT
---
Host: 'http://example.com/document'
---
Test Content
DOCUMENT
            ,
            $this->filesystem->read($filename)
        );
    }
}
