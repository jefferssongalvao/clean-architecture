<?php

namespace CleanArchitecture\Tests\Unit\Domain\Ordinary;

use CleanArchitecture\Academic\Domain\Ordinary\CPF;
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
