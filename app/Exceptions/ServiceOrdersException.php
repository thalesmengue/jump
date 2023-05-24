<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class ServiceOrdersException extends Exception
{
    public static function notFoundAnyServiceOrderByPlate(): ServiceOrdersException
    {
        return new self('Not found any service order by this plate!', Response::HTTP_NOT_FOUND);
    }
}
