<?php
declare(strict_types=1);

namespace Retriever\Domain\Exception;

use Exception;

class RetrieverException extends Exception
{
    /** @var mixed */
    protected $related;

    /**
     * @return mixed
     */
    public function getRelated()
    {
        return $this->related;
    }
}
