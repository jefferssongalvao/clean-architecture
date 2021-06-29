<?php

namespace CleanArchitecture\Academic\Infrastructure\Recommendation;

use CleanArchitecture\Academic\Application\Recommendation\SendEmailInterface;
use CleanArchitecture\Academic\Domain\Student\Student;

class SendEmailMail implements SendEmailInterface
{
    public function sendTo(Student $studentIndicated): void
    {
    }
}
