<?php

namespace CleanArchitecture\Infrastructure\Recommendation;

use CleanArchitecture\Application\Recommendation\SendEmailInterface;
use CleanArchitecture\Domain\Student\Student;

class SendEmailMail implements SendEmailInterface
{
    public function sendTo(Student $studentIndicated): void
    {
    }
}