<?php

namespace CleanArchitecture\Academic\Domain\Student\Exceptions;

class StudentNotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct("There is no student");
    }
}