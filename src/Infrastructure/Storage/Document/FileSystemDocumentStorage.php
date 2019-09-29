<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document;

use League\Flysystem\Filesystem;
use Retriever\Domain\DocumentStorage;
use Retriever\Domain\FetchedDocument;
use Retriever\Infrastructure\Storage\Document\FilenameInflector\BasicFilenameInflector;
use Retriever\Infrastructure\Storage\Exception\CantStoreFileException;

class FileSystemDocumentStorage implements DocumentStorage
{
    /** @var Filesystem */
    private $fileSystem;

    /** @var FilenameInflector */
    private $filenameInflector;

    /** @var bool */
    private $overwriteIfExists;

    public function __construct(
        Filesystem $fileSystem,
        FilenameInflector $filenameInflector = null,
        bool $overwriteIfExists = false
    ) {
        $this->fileSystem = $fileSystem;
        $this->filenameInflector = $filenameInflector ?? new BasicFilenameInflector();
        $this->overwriteIfExists = $overwriteIfExists;
    }

    public function store(FetchedDocument $document): void
    {
        $filename = $filename ?? $this->filenameInflector->inflect($document);

        if ($this->fileSystem->has($filename) === true && $this->overwriteIfExists === false) {
            throw CantStoreFileException::becauseItAlreadyExists($filename);
        }

        $this->fileSystem->put(
            $filename,
            $document->getDocumentContent()
        );
    }
}
