<?php

namespace App\Repository;

use App\Entity\CoordinatesLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoordinatesLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoordinatesLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoordinatesLog[]    findAll()
 * @method CoordinatesLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoordinatesLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoordinatesLog::class);
    }

    // /**
    //  * @return CoordinatesLog[] Returns an array of CoordinatesLog objects
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
    public function findOneBySomeField($value): ?CoordinatesLog
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
