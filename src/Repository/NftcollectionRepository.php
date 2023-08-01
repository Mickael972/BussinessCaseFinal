<?php

namespace App\Repository;

use App\Entity\Nftcollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nftcollection>
 *
 * @method Nftcollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nftcollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nftcollection[]    findAll()
 * @method Nftcollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NftcollectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nftcollection::class);
    }

//    /**
//     * @return Nftcollection[] Returns an array of Nftcollection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Nftcollection
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
