<?php

namespace App\Service;

use App\Entity\Mod;
use App\Search\Filter\ModSearchFilter;
use Doctrine\ORM\EntityManagerInterface;

readonly class ModSearchService {
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function search(ModSearchFilter $filter): array {
        return $this->entityManager->getRepository(Mod::class)->search($filter);
    }
}
