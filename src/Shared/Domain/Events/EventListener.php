<?php

namespace CleanArchitecture\Shared\Domain\Events;

abstract class EventListener
{
    public function process(EventInterface $event): void
    {
        if ($this->knowHowToProcess($event)) {
            $this->reactTo($event);
        }
    }

    abstract protected function knowHowToProcess(EventInterface $event): bool;
    abstract protected function reactTo(EventInterface $event): void;
}