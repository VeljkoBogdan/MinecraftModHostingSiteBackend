<?php

namespace App\Repository;

use App\Entity\Mod;
use App\Search\Filter\ModSearchFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mod>
 */
class ModRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mod::class);
    }

    public function search(ModSearchFilter $filter) {
        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.categories', 'c')
            ->leftJoin('m.loaders', 'l')
            ->leftJoin('m.versions', 'v')
            ->addSelect('c', 'l', 'v');

        // Filter by text
        if (!empty($filter->query)) {
            $qb->andWhere('LOWER(m.name) LIKE :query OR LOWER(m.description) LIKE :query')
                ->setParameter('query', '%' . strtolower($filter->query) . '%');
        }

        // Filter by categories
        if (!empty($filter->categories)) {
            $qb->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $filter->categories);
        }

        // Filter by loaders
        if (!empty($filter->loaders)) {
            $qb->andWhere('l.id IN (:loaders)')
                ->setParameter('loaders', $filter->loaders);
        }

        // Filter by side
        if (!empty($filter->side)) {
            $qb->andWhere('m.side = :side')
                ->setParameter('side', $filter->side);
        }

        // Filter by license
        if (!empty($filter->license)) {
            $qb->andWhere('m.license = :license')
                ->setParameter('license', $filter->license);
        }

        $qb->orderBy('m.updatedAt', 'DESC');

        return $qb->getQuery()->getResult();

    }
}
