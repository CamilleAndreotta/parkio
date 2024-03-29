<?php

namespace App\Repository;

use App\Entity\Laptop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Laptop>
 *
 * @method Laptop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Laptop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Laptop[]    findAll()
 * @method Laptop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaptopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Laptop::class);
    }

    public function add(Laptop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Laptop $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Laptop[] Returns an array of Laptop objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Laptop
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

       /**
       * Find Internal Relation for laptop
       *
       * @param [type] $id
       * @return array
       */
        public function findLaptopAndInternalLocation($id){
        
        $sql = 
        "
        Select * from laptop
        Inner Join internal_location on laptop.id = internal_location.laptop_id
        Where laptop.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

        }


       /**
       * Find External Relation for laptop
       *
       * @param [type] $id
       * @return array
       */
        public function findLaptopAndExternalLocation($id){
        
        $sql = 
        "
        Select * from laptop
        Inner Join external_location on laptop.id = external_location.laptop_id
        Where laptop.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

        }

}
