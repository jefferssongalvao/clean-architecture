<?php

namespace CleanArchitecture\Domain\Ordinary\Events;

class EventPublisher
{
    /** @var EventListener[] */
    private array $listeners;

    public function addListener(EventListener $eventListener): void
    {
        $this->listeners[] = $eventListener;
    }

    public function publish(Event $event): void
    {
        foreach ($this->listeners as $listener) {
            $listener->process($event);
        }
    }
}