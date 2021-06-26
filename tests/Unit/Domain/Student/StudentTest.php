<?php

namespace CleanArchitecture\Tests\Unit\Student;

use CleanArchitecture\Domain\Student\Student;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    public function testCreatesValidStudentWith2Phone(): void
    {
        $student = Student::withCpfNameEmail("12345678909", "Name", "name@test.com")
            ->addPhone("84", "999999999")
            ->addPhone("84", "988888888")
            ->student();
        $phones = $student->phones();

        self::assertIsObject($student);

        self::assertSame("123.456.789-09", (string) $student->cpf());
        self::assertSame("Name", (string) $student->name());
        self::assertSame("name@test.com", (string) $student->email());

        self::assertCount(2, $phones);

        self::assertSame("(84) 9 9999-9999", (string) $phones[0]);
        self::assertSame("(84) 9 8888-8888", (string) $phones[1]);
    }
}