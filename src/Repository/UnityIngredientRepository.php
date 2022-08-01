<?php

namespace App\Repository;

use App\Entity\UnityIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnityIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnityIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnityIngredient[]    findAll()
 * @method UnityIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnityIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnityIngredient::class);
    }

    // /**
    //  * @return UnityIngredient[] Returns an array of UnityIngredient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UnityIngredient
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
