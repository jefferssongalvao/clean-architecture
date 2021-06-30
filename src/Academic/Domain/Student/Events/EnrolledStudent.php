<?php

namespace CleanArchitecture\Academic\Domain\Student\Events;

use CleanArchitecture\Shared\Domain\CPF\CPF;
use CleanArchitecture\Shared\Domain\Events\EventInterface;

class EnrolledStudent implements EventInterface
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

    public function eventName(): string
    {
        return "EnrolledStudent";
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}