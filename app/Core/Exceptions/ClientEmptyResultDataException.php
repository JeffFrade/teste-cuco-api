<?php

namespace App\Core\Exceptions;

use App\Core\Interfaces\ClientExceptionInterface;
use App\Core\Support\BaseException;

class ClientEmptyResultDataException extends BaseException implements ClientExceptionInterface
{}
