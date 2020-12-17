<?php

namespace App\Core\Exceptions;

use App\Core\Interfaces\ClientExceptionInterface;
use App\Core\Support\BaseException;
use Throwable;

class ClientNonexistentIdException extends BaseException implements ClientExceptionInterface
{
    /**
     * ClientNonexistentIdException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf(trans('exceptions.client-nonexistent-id', $message)), $code, $previous);
    }
}
