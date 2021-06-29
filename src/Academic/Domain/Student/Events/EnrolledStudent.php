<?php

namespace CleanArchitecture\Academic\Domain\Student\Events;

use CleanArchitecture\Shared\Domain\CPF\CPF;
use CleanArchitecture\Academic\Domain\Ordinary\Events\Event;

class EnrolledStudent implements Event
{
    private \DateTimeImmutable $moment;
    private CPF $cpf;
    public function __construct(CPF $cpf)
    {
        $this->moment = new \DateTimeImmutable();
        $this->cpf = $cpf;
    }

    public function cpf(): CPF
    {
        return $this->cpf;
    }

    public function moment(): \DateTimeImmutable
    {
        return $this->moment;
    }
}
