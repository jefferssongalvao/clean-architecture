<?php

namespace CleanArchitecture\Shared\Domain\Events;

interface EventInterface extends \JsonSerializable
{
    public function moment(): \DateTimeImmutable;
    public function eventName(): string;
}