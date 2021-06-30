<?php

namespace CleanArchitecture\Shared\Domain\Events;

class EventPublisher
{
    /** @var EventListener[] */
    private array $listeners;

    public function addListener(EventListener $eventListener): void
    {
        $this->listeners[] = $eventListener;
    }

    public function publish(EventInterface $event): void
    {
        foreach ($this->listeners as $listener) {
            $listener->process($event);
        }
    }
}