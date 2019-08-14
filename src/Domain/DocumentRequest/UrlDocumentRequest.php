<?php
declare(strict_types=1);

namespace Retriever\Domain\DocumentRequest;

use Retriever\Domain\BaseDocumentRequest;
use Retriever\Domain\Exception\DocumentRequestException;

final class UrlDocumentRequest extends BaseDocumentRequest
{
    /** @var string  */
    public const TYPE = 'url';

    public function __construct(string $uri)
    {
        if (false === filter_var($uri, FILTER_VALIDATE_URL)) {
            throw DocumentRequestException::invalidDocumentHandler($uri);
        }

        parent::__construct($uri, self::TYPE);
    }
}
