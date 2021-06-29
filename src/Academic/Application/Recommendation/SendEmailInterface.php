<?php

namespace CleanArchitecture\Academic\Application\Recommendation;

use CleanArchitecture\Academic\Domain\Student\Student;

interface SendEmailInterface
{
    public function sendTo(Student $studentIndicated): void;
}