<?php

namespace CleanArchitecture\Domain\Student;

use CleanArchitecture\Domain\CPF;

class StudentNotFoundException extends \DomainException
{
    public function __construct(CPF $cpf)
    {
        parent::__construct("Student with CPF $cpf not found");
    }
}