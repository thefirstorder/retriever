<?php
declare(strict_types=1);

namespace Retriever\Domain;

abstract class BaseDocumentRequest implements DocumentRequest
{
    /** @var string */
    private $documentType;

    /** @var string */
    private $documentHandler;

    protected function __construct(string $documentHandler, string $documentType)
    {
        $this->documentHandler = $documentHandler;
        $this->documentType = $documentType;
    }

    public function getDocumentHandler(): string
    {
        return $this->documentHandler;
    }

    public function getDocumentType(): string
    {
        return (string) $this->documentType;
    }
}
