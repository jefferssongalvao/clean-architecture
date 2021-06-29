<?php

namespace CleanArchitecture\Tests\Unit\Domain\Ordinary;

use CleanArchitecture\Academic\Domain\Ordinary\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email("email invalid");
    }

    public function testValidEmailAsString(): void
    {
        $email = new Email("jeffersson@gmail.com");
        self::assertEquals("jeffersson@gmail.com", (string) $email);
    }
}
