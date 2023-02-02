<?php

namespace App\Domain\BusinessTrip\Repository;

use App\Domain\BusinessTrip\Entity\BusinessTrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BusinessTrip>
 *
 * @method BusinessTrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusinessTrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusinessTrip[]    findAll()
 * @method BusinessTrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusinessTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusinessTrip::class);
    }

    public function save(BusinessTrip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BusinessTrip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BusinessTrip[] Returns an array of BusinessTrip objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BusinessTrip
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
