<?php

namespace App\Repository;

use App\Entity\TourismeRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TourismeRegion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TourismeRegion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TourismeRegion[]    findAll()
 * @method TourismeRegion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourismeRegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TourismeRegion::class);
    }

    // /**
    //  * @return TourismeRegion[] Returns an array of TourismeRegion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TourismeRegion
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
