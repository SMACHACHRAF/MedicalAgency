<?php

namespace App\Repository;

use App\Entity\CurrentTreatments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CurrentTreatments|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurrentTreatments|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurrentTreatments[]    findAll()
 * @method CurrentTreatments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrentTreatmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurrentTreatments::class);
    }

    // /**
    //  * @return CurrentTreatments[] Returns an array of CurrentTreatments objects
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
    public function findOneBySomeField($value): ?CurrentTreatments
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
