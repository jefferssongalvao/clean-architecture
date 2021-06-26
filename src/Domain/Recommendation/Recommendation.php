<?php

namespace CleanArchitecture\Domain\Recommendation;

use CleanArchitecture\Domain\Student\Student;

class Recommendation
{
    private Student $indicator;
    private Student $indicated;
    private \DateTimeImmutable $recommendationDate;

    public function __construct(Student $indicator, Student $indicated)
    {
        $this->indicator = $indicator;
        $this->indicated = $indicated;

        $this->recommendationDate = new \DateTimeImmutable();
    }
}