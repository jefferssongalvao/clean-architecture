<?php

namespace CleanArchitecture\Tests\Gamification\Unit\Application;

use CleanArchitecture\Gamification\Application\SearchSealsByUser\SearchSealsByUser;
use CleanArchitecture\Gamification\Application\SearchSealsByUser\SearchSealsByUserCommand;
use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Gamification\Infrastructure\SealRepositoryMemory;
use CleanArchitecture\Shared\Domain\CPF\CPF;
use PHPUnit\Framework\TestCase;

class SearchSealsByUserTest extends TestCase
{
    public function testSealMustBeAddedToRepository(): void
    {
        $seal = new Seal(new CPF("12345678909"), "New Seal");
        $dataSeal = new SearchSealsByUserCommand("12345678909");

        $sealRepository = new SealRepositoryMemory();
        $sealRepository->add($seal);

        $enrollStudent = new SearchSealsByUser($sealRepository);
        $seals = $enrollStudent->execute($dataSeal);

        self::assertCount(1, $seals);
        self::assertSame($seal, $seals[0]);
    }
}