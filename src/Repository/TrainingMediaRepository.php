<?php

namespace App\Repository;

use App\Entity\TrainingMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingMedia>
 *
 * @method TrainingMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingMedia[]    findAll()
 * @method TrainingMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingMedia::class);
    }

//    /**
//     * @return TrainingMedia[] Returns an array of TrainingMedia objects
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

//    public function findOneBySomeField($value): ?TrainingMedia
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
