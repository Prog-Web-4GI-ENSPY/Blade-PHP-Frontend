<?php

namespace App\Exceptions;

use Exception;

class ProductInsufficientException extends Exception
{
    protected $code = 400; // HTTP code

    public function __construct($message = "Available Product Quantity Insufficient", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
