<?php

namespace App\Repository;

use App\Entity\Dates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dates>
 */
class DatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dates::class);
    }

    //    /**
    //     * @return Dates[] Returns an array of Dates objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    private function setUpQueryBuilder(QueryBuilder $qb, $id): QueryBuilder
    {
        return $qb
            ->join('d.PatentID', 'p')
            ->join('d.DatesHaveTypes', 'dt')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
        ;
    }

    public function returnDatesByType($order, $id): array
    {
        $qb = $this->createQueryBuilder('d');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('dt.DateType', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('dt.DateType', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnDatesByDateShort($order, $id): array
    {
        $qb = $this->createQueryBuilder('d');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.DateShort', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.DateShort', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnDatesByDateLong($order, $id): array
    {
        $qb = $this->createQueryBuilder('d');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.DateLong', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.DateLong', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnDatesByGracePeriod($order, $id): array
    {
        $qb = $this->createQueryBuilder('d');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.GracePeriod', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('d.GracePeriod', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    //    public function findOneBySomeField($value): ?Dates
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
