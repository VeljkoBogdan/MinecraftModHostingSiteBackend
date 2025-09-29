<?php

namespace App\Repository;

use App\Entity\GameVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameVersion>
 */
class GameVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameVersion::class);
    }

    //    /**
    //     * @return ModVersion[] Returns an array of ModVersion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ModVersion
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
