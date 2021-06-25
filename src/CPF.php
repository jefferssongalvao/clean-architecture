<?php

namespace CleanArchitecture;

class CPF
{
    private string $cpf;
    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}