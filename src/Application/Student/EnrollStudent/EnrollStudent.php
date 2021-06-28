<?php

namespace CleanArchitecture\Application\Student\EnrollStudent;

use CleanArchitecture\Domain\Student\Student;
use CleanArchitecture\Domain\Student\StudentRepositoryInterface;

class EnrollStudent
{
    private StudentRepositoryInterface $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function execute(EnrollStudentCommand $studentData): void
    {
        $student = Student::withCpfNameEmail(
            $studentData->cpf(),
            $studentData->name(),
            $studentData->email()
        );
        $this->studentRepository->add($student);
    }
}