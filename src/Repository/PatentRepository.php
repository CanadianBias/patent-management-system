<?php

namespace App\Repository;

use App\Entity\Patent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patent>
 */
class PatentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patent::class);
    }

    //    /**
    //     * @return Patent[] Returns an array of Patent objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }


    private function setUpQueryBuilder(QueryBuilder $qb, $id): QueryBuilder
    {
        return $qb
            ->join('p.Inventors', 'i')
            ->andWhere('i.id = :id')
            ->setParameter('id', $id)
        ;
    }

    public function returnPatentsByTitle($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.Title', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.Title', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByIRN($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.IRN', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.IRN', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByPatentNumber($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentNumber', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentNumber', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByCategory($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsAreCategorized', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsAreCategorized', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByLanguage($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveLanguage', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveLanguage', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByLocalization($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveLocalization', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveLocalization', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }

    public function returnPatentsByStatus($order, $id): array
    {
        $qb = $this->createQueryBuilder('p');
        if ($order === 'ASC') {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveStatus', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        } else {
            return $this->setUpQueryBuilder($qb, $id)
                ->orderBy('p.PatentsHaveStatus', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }
    }


    // public function sortUserResultByField($id, $field, $direction): array
    // {
    //     $field = 'p.' . $field;
    //     // return $this->createQueryBuilder('p')
    //     //     // ->addSelect('Inventor')
    //     //     // ->innerJoin('p.Inventors', 'Inventor')
    //     //     // ->andWhere('Inventor.id = :id')
    //     //     ->setParameters(new ArrayCollection([
    //     //         new Parameter('id', $id),
    //     //         new Parameter('1', $field),
    //     //         new Parameter('2', $direction)
    //     //     ]))
    //     //     ->join('p.Inventors', 'i')
    //     //     ->andWhere('i.id = :id')
    //     //     ->orderBy('?1', '?2')
    //     //     // ->setParameter('id', $id)
    //     //     // ->setParameter('field', $field)
    //     //     // ->setParameter('direction', $direction)
    //     //     ->getQuery()
    //     //     ->getResult()
    //     // ;
    //     return $this->createQuery(
    //         'SELECT p, i FROM App\Entity\Patent JOIN p.Inventors i WHERE i.id = :id', $id
    //     );
    // }

    //    public function findOneBySomeField($value): ?Patent
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
