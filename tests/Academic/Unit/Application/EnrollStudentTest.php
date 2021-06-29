<?php

namespace CleanArchitecture\Tests\Academic\Unit\Application;

use CleanArchitecture\Academic\Application\Student\EnrollStudent\EnrollStudent;
use CleanArchitecture\Academic\Application\Student\EnrollStudent\EnrollStudentCommand;
use CleanArchitecture\Academic\Domain\Ordinary\CPF;
use CleanArchitecture\Academic\Domain\Ordinary\Events\EventPublisher;
use CleanArchitecture\Academic\Domain\Student\Log\EnrolledStudentLog;
use CleanArchitecture\Academic\Infrastructure\Student\StudentRepositoryMemory;
use PHPUnit\Framework\TestCase;

class EnrollStudentTest extends TestCase
{
    private EventPublisher $publisher;
    public function setUp(): void
    {
        $this->publisher = new EventPublisher();
        $this->publisher->addListener(new EnrolledStudentLog());
    }

    public function testStudentMustBeAddedToRepository(): void
    {
        $dataStudent = new EnrollStudentCommand(
            "12345678909",
            "New Student",
            "student@example.com"
        );

        $studentRepository = new StudentRepositoryMemory();
        $enrollStudent = new EnrollStudent($studentRepository, $this->publisher);

        $enrollStudent->execute($dataStudent);



        $student = $studentRepository->searchByCPF(new CPF($dataStudent->cpf()));
        self::assertSame("New Student", (string) $student->name());
        self::assertSame("student@example.com", (string) $student->email());
        self::assertEmpty($student->phones());
    }
}