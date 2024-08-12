<?php

namespace App\Repository;

use App\Entity\SmokingQte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SmokingQte|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmokingQte|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmokingQte[]    findAll()
 * @method SmokingQte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmokingQteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmokingQte::class);
    }

    // /**
    //  * @return SmokingQte[] Returns an array of SmokingQte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SmokingQte
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
