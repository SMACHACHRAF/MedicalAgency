<?php

namespace App\Repository;

use App\Entity\MedicalFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MedicalFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalFiles[]    findAll()
 * @method MedicalFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalFiles::class);
    }

    // /**
    //  * @return MedicalFiles[] Returns an array of MedicalFiles objects
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
    public function findOneBySomeField($value): ?MedicalFiles
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
