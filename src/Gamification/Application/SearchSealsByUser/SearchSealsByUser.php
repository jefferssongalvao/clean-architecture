<?php

namespace CleanArchitecture\Gamification\Application\SearchSealsByUser;

use CleanArchitecture\Gamification\Domain\Seal\Seal;
use CleanArchitecture\Gamification\Domain\Seal\SealRepositoryInterface;
use CleanArchitecture\Shared\Domain\CPF\CPF;

class SearchSealsByUser
{
    private SealRepositoryInterface $sealRepository;
    public function __construct(SealRepositoryInterface $sealRepository)
    {
        $this->sealRepository = $sealRepository;
    }

    /** @return Seal[] */
    public function execute(SearchSealsByUserCommand $data): array
    {
        $cpf = new CPF($data->cpf());
        return $this->sealRepository->studentSealsWithCpf($cpf);
    }
}