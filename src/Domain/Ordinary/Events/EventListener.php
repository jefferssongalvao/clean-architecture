<?php

namespace CleanArchitecture\Domain\Ordinary\Events;

abstract class EventListener
{
    public function process(Event $event): void
    {
        if ($this->knowHowToProcess($event)) {
            $this->reactTo($event);
        }
    }

    abstract public function knowHowToProcess(Event $event): bool;
    abstract public function reactTo(Event $event): void;
}