<?php

namespace App\Repository;

use App\Entity\PlanningMenuDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningMenuDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningMenuDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningMenuDetail[]    findAll()
 * @method PlanningMenuDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningMenuDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningMenuDetail::class);
    }

    public function getAllDays()
    {
        $qb = $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();

        dd($qb);
    }

    // /**
    //  * @return PlanningMenuDetail[] Returns an array of PlanningMenuDetail objects
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
    public function findOneBySomeField($value): ?PlanningMenuDetail
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
