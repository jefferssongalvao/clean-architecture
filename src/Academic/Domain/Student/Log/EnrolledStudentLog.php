<?php

namespace CleanArchitecture\Academic\Domain\Student\Log;

use CleanArchitecture\Academic\Domain\Student\Events\EnrolledStudent;
use CleanArchitecture\Shared\Domain\Events\Event;
use CleanArchitecture\Shared\Domain\Events\EventListener;

class EnrolledStudentLog extends EventListener
{
    /** @param EnrolledStudent $enrolledStudent */
    public function reactTo(Event $enrolledStudent): void
    {
        fprintf(
            STDERR,
            "Student with CPF %s was enrolled on %s" . PHP_EOL,
            (string) $enrolledStudent->cpf(),
            $enrolledStudent->moment()->format('d/m/Y')
        );
    }

    public function knowHowToProcess(Event $event): bool
    {
        return $event instanceof EnrolledStudent;
    }
}