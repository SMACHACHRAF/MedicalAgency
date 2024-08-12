<?php

namespace App\Repository;

use App\Entity\MedicalCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MedicalCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalCity[]    findAll()
 * @method MedicalCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalCity::class);
    }

    // /**
    //  * @return MedicalCity[] Returns an array of MedicalCity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalCity
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
