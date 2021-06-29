<?php

namespace CleanArchitecture\Gamification\Domain\Seal;

use CleanArchitecture\Shared\Domain\CPF\CPF;

class Seal
{
    private CPF $cpf;
    private string $name;

    public function __construct(Cpf $cpf, string $name)
    {
        $this->cpf = $cpf;
        $this->name = $name;
    }

    public function cpf(): Cpf
    {
        return $this->cpf;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}