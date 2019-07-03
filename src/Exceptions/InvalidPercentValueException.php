<?php

namespace FunFirst\TaxCalculator\Exceptions;

class InvalidPercentValueException extends \Exception 
{
    public function __construct()
    {
        parent::__construct('Invalid percent value. Percent value has to be >= 0 && <= 1');
    }
}