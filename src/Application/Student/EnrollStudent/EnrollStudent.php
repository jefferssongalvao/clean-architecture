<?php

namespace CleanArchitecture\Application\Student\EnrollStudent;

use CleanArchitecture\Domain\Ordinary\Events\EventPublisher;
use CleanArchitecture\Domain\Student\Events\EnrolledStudent;
use CleanArchitecture\Domain\Student\Student;
use CleanArchitecture\Domain\Student\StudentRepositoryInterface;

class EnrollStudent
{
    private StudentRepositoryInterface $studentRepository;
    private EventPublisher $eventPublisher;
    public function __construct(StudentRepositoryInterface $studentRepository, EventPublisher $eventPublisher)
    {
        $this->studentRepository = $studentRepository;
        $this->eventPublisher = $eventPublisher;
    }

    public function execute(EnrollStudentCommand $studentData): void
    {
        $student = Student::withCpfNameEmail(
            $studentData->cpf(),
            $studentData->name(),
            $studentData->email()
        );
        $this->studentRepository->add($student);

        $event = new EnrolledStudent($student->cpf());
        $this->eventPublisher->publish($event);
    }
}