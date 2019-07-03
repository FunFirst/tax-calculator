<?php

namespace FunFirst\TaxCalculator\Exceptions;

class InvalidValueException extends \Exception 
{
    public function __construct($message = null)
    {
        if ($message === null) {
            $message = 'Invalid value';
        }
        parent::__construct($message);
    }
}