<?php

namespace App\Repository;

use App\Entity\SeccionContenidos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeccionContenidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeccionContenidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeccionContenidos[]    findAll()
 * @method SeccionContenidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeccionContenidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeccionContenidos::class);
    }

    // /**
    //  * @return SeccionContenidos[] Returns an array of SeccionContenidos objects
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
    public function findOneBySomeField($value): ?SeccionContenidos
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
