<?php

namespace CleanArchitecture\Tests\Academic\Unit\Domain\Ordinary;

use CleanArchitecture\Shared\Domain\CPF\CPF;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function testInvalidCPFThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new CPF("12345678900");
    }

    public function testValidCpfAsString(): void
    {
        $cpf = new CPF("123.456.789-09");
        self::assertEquals("123.456.789-09", (string) $cpf);
    }
}
