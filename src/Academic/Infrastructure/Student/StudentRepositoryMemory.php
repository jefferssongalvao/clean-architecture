<?php

namespace CleanArchitecture\Academic\Infrastructure\Student;

use CleanArchitecture\Shared\Domain\CPF\CPF;
use CleanArchitecture\Academic\Domain\Student\Exceptions\StudentNotFoundException;
use CleanArchitecture\Academic\Domain\Student\Student;
use CleanArchitecture\Academic\Domain\Student\StudentRepositoryInterface;
use Exception;

class StudentRepositoryMemory implements StudentRepositoryInterface
{
    /** @var Student[] */
    private array $students;
    public function __construct()
    {
        $this->students = [];
    }

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function searchByCPF(CPF $cpf): Student
    {
        $studentFiltered = array_filter(
            $this->students,
            fn (Student $student) => $student->cpf() == $cpf
        );
        if (count($studentFiltered) === 0)
            throw new StudentNotFoundException();

        if (count($studentFiltered) > 1)
            throw new Exception();

        return $studentFiltered[0];
    }

    /** @return Student[] */
    public function searchAll(): array
    {
        return $this->students;
    }
}
