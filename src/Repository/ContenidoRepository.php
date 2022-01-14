<?php

namespace App\Repository;

use App\Entity\Contenido;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contenido|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenido|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenido[]    findAll()
 * @method Contenido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenidoRepository extends ServiceEntityRepository
{
    // public const PAGINATOR_PER_PAGE = 8;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenido::class);
    }

    // Funcion para el paginador
    /* public function getContenidoPaginator(int $offset, string $order): Paginator
    {

        $query = $this->createQueryBuilder('s') 
            ->orderBy('s.'.$order, 'ASC')
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
        ;

        return new Paginator($query);
    } */

    // /**
    //  * @return Contenido[] Returns an array of Contenido objects
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
    public function findOneBySomeField($value): ?Contenido
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
