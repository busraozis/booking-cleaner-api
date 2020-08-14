<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findCleanerIdByStartTimeEndTime($startTime,$endTime){
        return $this->createQueryBuilder('b')
        ->select('b.cleanerId')
        ->andWhere('b.startTime < :endTime')
        ->andWhere('b.endTime > :startTime')
        ->setParameter('startTime', $startTime)
        ->setParameter('endTime', $endTime)
        ->distinct()
        ->getQuery()
        ->getResult();
    }

    public function findBookingByCleanerIdStartTimeEndTime($cleanerId,$startTime,$endTime){
        return $this->createQueryBuilder('b')
        ->select('b.id')
        ->andWhere('b.startTime < :endTime')
        ->andWhere('b.endTime > :startTime')
        ->andWhere('b.cleanerId= :cleanerId')
        ->setParameter('startTime', $startTime)
        ->setParameter('endTime', $endTime)
        ->setParameter('cleanerId', $cleanerId)
        ->distinct()
        ->getQuery()
        ->getResult();
    }

    public function findCleanerIdByCustomerIdStartTimeEndTime($customerId,$startTime,$endTime){
        return $this->createQueryBuilder('b')
        ->select('b.cleanerId')
        ->andWhere('b.startTime < :endTime')
        ->andWhere('b.endTime > :startTime')
        ->andWhere('b.customerId = :customerId')
        ->setParameter('startTime', $startTime)
        ->setParameter('endTime', $endTime)
        ->setParameter('customerId', $customerId)
        ->distinct()
        ->getQuery()
        ->getResult();

    }

    public function findStartTimeEndTimeByCleanerId($cleanerId){
        return $this->createQueryBuilder('b')
        ->select('b.startTime','b.endTime')
        ->andWhere('b.cleanerId = :cleanerId')
        ->setParameter('cleanerId', $cleanerId)
        ->distinct()
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
