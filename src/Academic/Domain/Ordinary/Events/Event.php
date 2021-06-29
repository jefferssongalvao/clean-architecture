<?php

namespace CleanArchitecture\Academic\Domain\Ordinary\Events;

interface Event
{
    public function moment(): \DateTimeImmutable;
}