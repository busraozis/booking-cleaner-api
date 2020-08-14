<?php

namespace App\Repository;

use App\Entity\Cleaner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method Cleaner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cleaner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cleaner[]    findAll()
 * @method Cleaner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CleanerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cleaner::class);
    }

    public function listAll(){
        return $result = $this->createQueryBuilder('c')
            ->select('c.id as cleanerId')
            ->getQuery()
            ->getResult();
    }

    public function findById($value)
    {

        try{
            $result = $this->createQueryBuilder('c')
            ->select('c.id','c.companyId','c.name')
            ->andWhere('c.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
        } catch(DBALException $e) {
            $result= $e->getMessage();
        }
        
        return $result;
        
    }

    // /**
    //  * @return Cleaner[] Returns an array of Cleaner objects
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
    public function findOneBySomeField($value): ?Cleaner
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
