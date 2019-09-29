<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Storage\Document\FilenameInflector;

use Retriever\Domain\Exception\RetrieverException;
use Retriever\Domain\FetchedDocument;
use Retriever\Infrastructure\Storage\Document\FilenameInflector;

class HostPathBasedFilenameInflector implements FilenameInflector
{
    public function inflect(FetchedDocument $document): string
    {
        $metadata = $document->getMetadata();

        if (false === array_key_exists('Host', $metadata)) {
            throw new RetrieverException(
                "Can't define a filename for a Fetched Document that doesn't have a Host Metadata"
            );
        }

        $parsedUrl = parse_url($metadata['Host']);

        return
            $this->processHost($parsedUrl) .
            $this->processPath($parsedUrl) .
            $this->processQuery($parsedUrl);
    }

    private function processHost($parsedUrl)
    {
        return $parsedUrl['host'] ?? 'unknown.domain';
    }

    private function processPath($parsedUrl)
    {
        if (!isset($parsedUrl['path']) || strlen($parsedUrl['path']) === 1) {
            $path = 'index.html';
        } else {
            $path = substr($parsedUrl['path'], 1);
        }

        return rtrim('/'. str_replace('/', '-', $path), '-');
    }

    private function processQuery($parsedUrl)
    {
        $query = $parsedUrl['query'] ?? null;
        return $query ? '-'.str_replace('&', '-', $query) : '';
    }
}
