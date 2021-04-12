<?php

namespace App\Repository;

use App\Entity\FraisGen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FraisGen|null find($id, $lockMode = null, $lockVersion = null)
 * @method FraisGen|null findOneBy(array $criteria, array $orderBy = null)
 * @method FraisGen[]    findAll()
 * @method FraisGen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FraisGenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FraisGen::class);
    }

    // /**
    //  * @return FraisGen[] Returns an array of FraisGen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FraisGen
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
