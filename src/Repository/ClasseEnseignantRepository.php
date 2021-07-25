<?php

namespace App\Repository;

use App\Entity\ClasseEnseignant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClasseEnseignant|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseEnseignant|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseEnseignant[]    findAll()
 * @method ClasseEnseignant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseEnseignantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseEnseignant::class);
    }

    // /**
    //  * @return ClasseEnseignant[] Returns an array of ClasseEnseignant objects
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
    public function findOneBySomeField($value): ?ClasseEnseignant
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
