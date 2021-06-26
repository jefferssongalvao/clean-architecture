<?php

namespace CleanArchitecture\Domain\Student;

use CleanArchitecture\Domain\CPF;

class StudentNotFoundException extends \DomainException
{
    public function __construct()
    {
        parent::__construct("There is no student");
    }
}