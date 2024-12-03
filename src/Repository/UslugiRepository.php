<?php

namespace App\Repository;

use App\Entity\Uslugi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Uslugi>
 *
 * @method Uslugi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uslugi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uslugi[]    findAll()
 * @method Uslugi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UslugiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uslugi::class);
    }

//    /**
//     * @return Uslugi[] Returns an array of Uslugi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Uslugi
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
