<?php

namespace App\Repository;

use App\Entity\ChoixBillet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChoixBillet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoixBillet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoixBillet[]    findAll()
 * @method ChoixBillet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoixBilletRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChoixBillet::class);
    }

    // /**
    //  * @return ChoixBillet[] Returns an array of ChoixBillet objects
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
    public function findOneBySomeField($value): ?ChoixBillet
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
