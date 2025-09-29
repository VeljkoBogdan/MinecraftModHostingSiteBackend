<?php

namespace App\Repository;

use App\Entity\ModFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModFile>
 */
class ModFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModFile::class);
    }

//    /**
//     * @return ModFile[] Returns an array of ModFile objects
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

//    public function findOneBySomeField($value): ?ModFile
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
