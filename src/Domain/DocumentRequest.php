<?php
declare(strict_types=1);

namespace Retriever\Domain;

interface DocumentRequest
{
    public function getDocumentType(): string;
}
