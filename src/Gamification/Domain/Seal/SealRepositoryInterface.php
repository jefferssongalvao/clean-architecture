<?php

namespace CleanArchitecture\Gamification\Domain\Seal;

use CleanArchitecture\Shared\Domain\CPF\CPF;

interface SealRepositoryInterface
{
    public function add(Seal $seal): void;
    public function studentSealsWithCpf(CPF $cpf): array;
}