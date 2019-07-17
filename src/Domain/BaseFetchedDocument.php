<?php
declare(strict_types=1);

namespace Retriever\Domain;

use ArrayIterator;

class BaseFetchedDocument implements FetchedDocument
{
    /** @var string */
    private $documentHandler;

    /** @var string */
    private $documentContent;

    /** @var array */
    private $metadata;

    public function __construct(
        string $documentHandler,
        string $documentContent,
        array $metadata = []
    ) {

        $this->documentHandler = $documentHandler;
        $this->documentContent = $documentContent;
        $this->metadata = new ArrayIterator($metadata);
    }

    public function getDocumentHandler(): string
    {
        return $this->documentHandler;
    }

    public function getDocumentContent(): string
    {
        return $this->documentContent;
    }

    public function getMetadata(): ArrayIterator
    {
        return $this->metadata;
    }
}
