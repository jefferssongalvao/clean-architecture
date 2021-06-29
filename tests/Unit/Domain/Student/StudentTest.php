<?php

namespace CleanArchitecture\Tests\Unit\Student;

use CleanArchitecture\Domain\Student\Exceptions\MaximumPhonesNumberExceededException;
use CleanArchitecture\Domain\Student\Student;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private Student $student;
    public function setUp(): void
    {
        $this->student = Student::withCpfNameEmail(
            "12345678909",
            "Name",
            "test@example.com"
        );
    }

    public function testCreatesValidStudent(): void
    {
        self::assertIsObject($this->student);

        self::assertSame("123.456.789-09", (string) $this->student->cpf());
        self::assertSame("Name", (string) $this->student->name());
        self::assertSame("test@example.com", (string) $this->student->email());
    }

    public function testCreatesValidStudentWith1Phone(): void
    {
        $this->student->addPhone("84", "999999999");
        $phones = $this->student->phones();

        self::assertCount(1, $phones);

        self::assertSame("(84) 9 9999-9999", (string) $phones[0]);
    }

    public function testCreatesValidStudentWith2Phone(): void
    {
        $this->student->addPhone("84", "999999999")
            ->addPhone("84", "988888888");
        $phones = $this->student->phones();

        self::assertCount(2, $phones);

        self::assertSame("(84) 9 9999-9999", (string) $phones[0]);
        self::assertSame("(84) 9 8888-8888", (string) $phones[1]);
    }

    public function testStudentCannotHaveMoreThan2Phones(): void
    {
        $this->expectException(MaximumPhonesNumberExceededException::class);
        $this->student
            ->addPhone("84", "999999999")
            ->addPhone("84", "988888888")
            ->addPhone("84", "988888888");
    }
}