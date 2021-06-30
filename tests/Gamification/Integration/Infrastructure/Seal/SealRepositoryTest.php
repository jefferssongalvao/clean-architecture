<?php

namespace CleanArchitecture\Tests\Gamification\Integration\Infrastructure\Seal;

use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Gamification\Domain\Seal\SealRepositoryInterface;
use CleanArchitecture\Gamification\Infrastructure\SealRepositoryMemory;
use CleanArchitecture\Shared\Domain\CPF\CPF;
use PHPUnit\Framework\TestCase;

class SealRepositoryTest extends TestCase
{
    private SealRepositoryInterface $sealRepository;
    public function setUp(): void
    {
        $this->sealRepository = new SealRepositoryMemory;
    }

    public function testAddSeal(): void
    {
        $cpf = new CPF("12345678909");
        $seal = new Seal($cpf, "New Seal");
        $this->sealRepository->add($seal);

        $seals = $this->sealRepository->seals();
        $sealsStudent = $this->sealRepository->studentSealsWithCpf($cpf);


        self::assertCount(1, $seals);
        self::assertCount(1, $sealsStudent);
        self::assertEquals($seal, $sealsStudent[0]);
    }
}