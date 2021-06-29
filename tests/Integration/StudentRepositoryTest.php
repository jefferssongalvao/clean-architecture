<?php

namespace CleanArchitecture\Tests\Integration;

use CleanArchitecture\Academic\Domain\Ordinary\CPF;
use CleanArchitecture\Academic\Domain\Student\Exceptions\StudentNotFoundException;
use CleanArchitecture\Academic\Domain\Student\Student;
use CleanArchitecture\Academic\Infrastructure\Student\StudentRepositoryPDO;
use PHPUnit\Framework\TestCase;

class StudentRepositoryTest extends TestCase
{
    private static \PDO $pdo;
    private StudentRepositoryPDO $studentRepository;
    public static function setUpBeforeClass(): void
    {
        self::$pdo = new \PDO("sqlite::memory:");
        self::$pdo->exec("
            CREATE TABLE students (
                cpf TEXT PRIMARY KEY,
                name TEXT,
                email TEXT
            );
            CREATE TABLE phones (
                ddd TEXT,
                number TEXT,
                cpf_student TEXT,
                PRIMARY KEY (ddd, number),
                FOREIGN KEY(cpf_student) REFERENCES students(cpf)
            );
        ");
    }

    protected function setUp(): void
    {
        self::$pdo->beginTransaction();
        $this->studentRepository = new StudentRepositoryPDO(self::$pdo);
    }

    public function testAddNewStudent(): void
    {
        $cpf = "123.456.789-09";
        $student = Student::withCpfNameEmail($cpf, "Name", "name@test.com")
            ->addPhone("84", "999999999")
            ->addPhone("84", "988888888");

        $this->studentRepository->add($student);

        /** @var Student $studentResult */
        $studentResult = $this->studentRepository->searchByCPF(new CPF($cpf));
        $phones = $studentResult->phones();

        self::assertIsObject($studentResult);

        self::assertSame("123.456.789-09", (string) $student->cpf());
        self::assertSame("Name", (string) $student->name());
        self::assertSame("name@test.com", (string) $student->email());

        self::assertCount(2, $phones);

        self::assertSame("(84) 9 9999-9999", (string) $phones[0]);
        self::assertSame("(84) 9 8888-8888", (string) $phones[1]);
    }

    public function testListAllAddedStudents(): void
    {
        $cpf1 = "123.456.789-09";
        $student1 = Student::withCpfNameEmail($cpf1, "Mary", "mary@test.com")
            ->addPhone("84", "999999999");
        $this->studentRepository->add($student1);

        $cpf2 = "062.777.184-01";
        $student2 = Student::withCpfNameEmail($cpf2, "John", "john@test.com")
            ->addPhone("84", "988888888");
        $this->studentRepository->add($student2);

        $students = $this->studentRepository->searchAll();

        self::assertCount(2, $students);
        self::assertEquals($student1, $students[$cpf1]);
        self::assertEquals($student2, $students[$cpf2]);
    }

    public function testCaseNoHasStudentWithCertainCPFThrowAnException(): void
    {
        $cpf = "12345678909";
        $this->expectException(StudentNotFoundException::class);
        $this->studentRepository->searchByCPF(new CPF($cpf));
    }

    public function testCaseNoHasStudentThrowAnException(): void
    {
        $this->expectException(StudentNotFoundException::class);
        $this->studentRepository->searchAll();
    }

    protected function tearDown(): void
    {
        self::$pdo->rollBack();
    }
}
