<?php

namespace App\Repository;

use App\Entity\PatientInformations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PatientInformations|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientInformations|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientInformations[]    findAll()
 * @method PatientInformations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientInformationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientInformations::class);
    }

    // /**
    //  * @return PatientInformations[] Returns an array of PatientInformations objects
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
    public function findOneBySomeField($value): ?PatientInformations
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
