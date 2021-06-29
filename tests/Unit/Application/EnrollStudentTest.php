<?php

namespace CleanArchitecture\Tests\Unit\Application;

use CleanArchitecture\Academic\Application\Student\EnrollStudent\EnrollStudent;
use CleanArchitecture\Academic\Application\Student\EnrollStudent\EnrollStudentCommand;
use CleanArchitecture\Academic\Domain\Ordinary\CPF;
use CleanArchitecture\Academic\Infrastructure\Student\StudentRepositoryMemory;
use PHPUnit\Framework\TestCase;

class EnrollStudentTest extends TestCase
{
    public function testStudentMustBeAddedToRepository(): void
    {
        $dataStudent = new EnrollStudentCommand(
            "12345678909",
            "New Student",
            "student@example.com"
        );

        $studentRepository = new StudentRepositoryMemory();
        $enrollStudent = new EnrollStudent($studentRepository);

        $enrollStudent->execute($dataStudent);



        $student = $studentRepository->searchByCPF(new CPF($dataStudent->cpf()));
        self::assertSame("New Student", (string) $student->name());
        self::assertSame("student@example.com", (string) $student->email());
        self::assertEmpty($student->phones());
    }
}
