<?php

namespace CleanArchitecture\Application\Recommendation;

use CleanArchitecture\Domain\Student\Student;

interface SendEmailInterface
{
    public function sendTo(Student $studentIndicated): void;
}