<?php

namespace App\Repository;

use App\Entity\Tabs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tabs>
 *
 * @method Tabs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tabs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tabs[]    findAll()
 * @method Tabs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TabsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tabs::class);
    }

//    /**
//     * @return Tabs[] Returns an array of Tabs objects
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

//    public function findOneBySomeField($value): ?Tabs
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
