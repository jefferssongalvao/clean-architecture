<?php

namespace CleanArchitecture\Gamification\Infrastructure;

use CleanArchitecture\Shared\Domain\CPF\CPF;
use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Gamification\Domain\Seal\SealRepositoryInterface;

class SealRepositoryMemory implements SealRepositoryInterface
{
    /** @var Seal[] $seals */
    private array $seals = [];
    public function add(Seal $seal): void
    {
        $this->seals[] = $seal;
    }

    public function studentSealsWithCpf(CPF $cpf): array
    {
        return array_filter($this->seals, fn (Seal $seal) => $seal->cpf() == $cpf);
    }

    /** @return Seal[] */
    public function seals(): array
    {
        return $this->seals;
    }
}