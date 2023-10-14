<?php

namespace Tools\Exceptions;

use Exception;

/**
 * Ошибка JWT токена
 */
class JWTTokenException extends Exception
{
    public function __construct(string $message)
    {
        $message = 'Неверный токен. ' . $message;
        parent::__construct($message);
    }
}
