<?php

namespace App\Repository;

use App\Entity\PreparationTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreparationTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreparationTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreparationTime[]    findAll()
 * @method PreparationTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreparationTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreparationTime::class);
    }

    // /**
    //  * @return PreparationTime[] Returns an array of PreparationTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PreparationTime
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
