<?php

namespace FunFirst\TaxCalculator\Exceptions;

class InvalidTypeException extends \Exception 
{
    public function __construct()
    {
        parent::__construct('Invalid value type passed to function.');
    }
}