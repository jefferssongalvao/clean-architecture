<?php

namespace CleanArchitecture\Domain\Student\Exceptions;

class MaximumPhonesNumberExceededException extends \DomainException
{
    public function __construct()
    {
        parent::__construct("Maximum Phones Number Exceeded");
    }
}