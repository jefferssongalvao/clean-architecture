<?php

namespace CleanArchitecture\Domain\Ordinary\Events;

interface Event
{
    public function moment(): \DateTimeImmutable;
}