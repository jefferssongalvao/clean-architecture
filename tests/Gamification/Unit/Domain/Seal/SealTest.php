<?php

namespace CleanArchitecture\Tests\Gamification\Domain\Seal;

use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Shared\Domain\CPF\CPF;
use PHPUnit\Framework\TestCase;

class SealTest extends TestCase
{
    public function testCreatesValidSeal(): void
    {
        $seal = new Seal(new CPF("12345678909"), "New Seal");

        self::assertSame("123.456.789-09", (string) $seal->cpf());
        self::assertSame("New Seal", (string) (string) $seal);
    }
}