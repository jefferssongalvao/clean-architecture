<?php

namespace CleanArchitecture\Application\Student\EnrollStudent;

class EnrollStudentCommand
{
    private string $cpf;
    private string $name;
    private string $email;

    public function __construct(string $cpf, string $name, string $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}