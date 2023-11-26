<?php

namespace App\Repository;

use App\Entity\TabType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TabType>
 *
 * @method TabType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TabType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TabType[]    findAll()
 * @method TabType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TabTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TabType::class);
    }

//    /**
//     * @return TabType[] Returns an array of TabType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TabType
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
