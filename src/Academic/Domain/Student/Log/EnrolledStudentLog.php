<?php

namespace CleanArchitecture\Academic\Domain\Student\Log;

use CleanArchitecture\Academic\Domain\Student\Events\EnrolledStudent;
use CleanArchitecture\Shared\Domain\Events\EventInterface;
use CleanArchitecture\Shared\Domain\Events\EventListener;

class EnrolledStudentLog extends EventListener
{
    /** @param EnrolledStudent $enrolledStudent */
    protected function reactTo(EventInterface $enrolledStudent): void
    {
        fprintf(
            STDERR,
            "Student with CPF %s was enrolled on %s" . PHP_EOL,
            (string) $enrolledStudent->cpf(),
            $enrolledStudent->moment()->format('d/m/Y')
        );
    }

    protected function knowHowToProcess(EventInterface $event): bool
    {
        return $event->eventName() === "EnrolledStudent";
    }
}