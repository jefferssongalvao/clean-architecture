<?php

namespace CleanArchitecture\Gamification\Application\Seal;

use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Gamification\Domain\Seal\SealRepositoryInterface;
use CleanArchitecture\Shared\Domain\Events\EventInterface;
use CleanArchitecture\Shared\Domain\Events\EventListener;

class GeneratesSealNewbie extends EventListener
{

    private SealRepositoryInterface $sealRepository;

    public function __construct(SealRepositoryInterface $sealRepository)
    {
        $this->sealRepository = $sealRepository;
    }

    protected function reactTo(EventInterface $event): void
    {
        $array = $event->jsonSerialize();
        $cpf = $array['cpf'];

        $seal = new Seal($cpf, 'Newbie');
        $this->sealRepository->add($seal);
    }

    protected function knowHowToProcess(EventInterface $event): bool
    {
        return $event->eventName() === "EnrolledStudent";
    }
}