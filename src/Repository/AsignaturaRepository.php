<?php

namespace App\Repository;

use App\Entity\Asignatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asignatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asignatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asignatura[]    findAll()
 * @method Asignatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsignaturaRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 8;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asignatura::class);
    }

    public function getAsignaturaPaginator(int $offset, string $order): Paginator
    {

        $query = $this->createQueryBuilder('a') 
            ->orderBy('a.'.$order, 'ASC')
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    public function getAsignaturasEstudiantePaginator(int $offset, string $order, int $estId): Paginator
    {

        $query = $this->createQueryBuilder('a') 
            ->orderBy('a.'.$order, 'ASC')
            ->innerJoin('a.estudiantes', 'e', 'WITH', 'e.id = :estId')
            ->setParameter('estId', $estId)
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    }

    // /**
    //  * @return Asignatura[] Returns an array of Asignatura objects
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
    public function findOneBySomeField($value): ?Asignatura
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
