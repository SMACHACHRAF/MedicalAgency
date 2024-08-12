<?php

namespace App\Repository;

use App\Entity\PreviousMedicalOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PreviousMedicalOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreviousMedicalOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreviousMedicalOperation[]    findAll()
 * @method PreviousMedicalOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreviousMedicalOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreviousMedicalOperation::class);
    }

    // /**
    //  * @return PreviousMedicalOperation[] Returns an array of PreviousMedicalOperation objects
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
    public function findOneBySomeField($value): ?PreviousMedicalOperation
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
