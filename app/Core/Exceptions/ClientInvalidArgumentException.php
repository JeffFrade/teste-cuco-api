<?php

namespace App\Core\Exceptions;

use App\Core\Interfaces\ClientExceptionInterface;
use App\Core\Support\BaseException;

class ClientInvalidArgumentException extends BaseException implements ClientExceptionInterface
{}
