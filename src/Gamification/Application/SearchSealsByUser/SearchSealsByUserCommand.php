<?php

namespace CleanArchitecture\Gamification\Application\SearchSealsByUser;

class SearchSealsByUserCommand
{
    private string $cpf;
    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }
}