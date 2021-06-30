<?php

namespace CleanArchitecture\Shared\Domain\Events;

interface Event
{
    public function moment(): \DateTimeImmutable;
}