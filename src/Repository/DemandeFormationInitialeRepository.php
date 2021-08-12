<?php

namespace App\Repository;

use App\Entity\DemandeFormationInitiale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeFormationInitiale|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeFormationInitiale|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeFormationInitiale[]    findAll()
 * @method DemandeFormationInitiale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeFormationInitialeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeFormationInitiale::class);
    }

    // /**
    //  * @return DemandeFormationInitiale[] Returns an array of DemandeFormationInitiale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeFormationInitiale
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
