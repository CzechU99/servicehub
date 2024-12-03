<?php

namespace App\Repository;

use App\Entity\DaneUzytkownika;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DaneUzytkownika>
 *
 * @method DaneUzytkownika|null find($id, $lockMode = null, $lockVersion = null)
 * @method DaneUzytkownika|null findOneBy(array $criteria, array $orderBy = null)
 * @method DaneUzytkownika[]    findAll()
 * @method DaneUzytkownika[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DaneUzytkownikaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DaneUzytkownika::class);
    }

//    /**
//     * @return DaneUzytkownika[] Returns an array of DaneUzytkownika objects
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

//    public function findOneBySomeField($value): ?DaneUzytkownika
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
