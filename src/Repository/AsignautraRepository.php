<?php

namespace App\Repository;

use App\Entity\Asignautra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asignautra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asignautra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asignautra[]    findAll()
 * @method Asignautra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignautraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asignautra::class);
    }

    // /**
    //  * @return Asignautra[] Returns an array of Asignautra objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Asignautra
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
