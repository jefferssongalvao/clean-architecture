<?php

namespace CleanArchitecture\Academic\Application\Student\EnrollStudent;

use CleanArchitecture\Academic\Domain\Student\Events\EnrolledStudent;
use CleanArchitecture\Academic\Domain\Student\Student;
use CleanArchitecture\Academic\Domain\Student\StudentRepositoryInterface;
use CleanArchitecture\Shared\Domain\Events\EventPublisher;

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