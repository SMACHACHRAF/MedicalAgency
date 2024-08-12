<?php

namespace App\Repository;

use App\Entity\CurrentDisease;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CurrentDisease|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentDisease|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentDisease[]    findAll()
 * @method CurrentDisease[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentDiseaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentDisease::class);
    }

    // /**
    //  * @return CurrentDisease[] Returns an array of CurrentDisease objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurrentDisease
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
