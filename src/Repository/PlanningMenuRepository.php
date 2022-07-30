<?php

namespace App\Repository;

use App\Entity\PlanningMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningMenu[]    findAll()
 * @method PlanningMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningMenu::class);
    }

    // /**
    //  * @return PlanningMenu[] Returns an array of PlanningMenu objects
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
    public function findOneBySomeField($value): ?PlanningMenu
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
