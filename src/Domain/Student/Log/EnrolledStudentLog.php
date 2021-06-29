<?php

namespace CleanArchitecture\Domain\Student\Log;

use CleanArchitecture\Domain\Ordinary\Events\Event;
use CleanArchitecture\Domain\Ordinary\Events\EventListener;
use CleanArchitecture\Domain\Student\Events\EnrolledStudent;

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