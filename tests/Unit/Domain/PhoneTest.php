<?php

namespace CleanArchitecture\Tests\Unit;

use CleanArchitecture\Domain\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testPhoneValid9DigitsAsString(): void
    {
        $phone = new Phone("61", "999999999");
        self::assertEquals("(61) 9 9999-9999", (string) $phone);
    }

    public function testPhoneValid8DigitsAsString(): void
    {
        $phone = new Phone("61", "99999999");
        self::assertEquals("(61) 9999-9999", (string) $phone);
    }

    public function testPhoneWithInvalidDDDThrowException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Phone("ddd", "999999999");
    }

    public function testPhoneWithBigNumberThrowException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Phone("61", "9999999999");
    }

    public function testPhoneWithSmallNumberThrowException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Phone("61", "9999999");
    }
}