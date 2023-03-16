<?php

namespace App\Repository;

use App\Entity\Mouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mouse>
 *
 * @method Mouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mouse[]    findAll()
 * @method Mouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mouse::class);
    }

    public function add(Mouse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mouse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Mouse[] Returns an array of Mouse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mouse
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

       /**
       * Find Internal Relation for Mouse
       *
       * @param [type] $id
       * @return array
       */
        public function findMouseAndInternalLocation($id){
        
        $sql = 
        "
        Select * from mouse 
        Inner Join internal_location on mouse.id = internal_location.mouse_id
        Where mouse.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

      }

      /**
       * Find External Relation for Mouse
       *
       * @param [type] $id
       * @return array
       */
      public function findMouseAndExternalLocation($id){
        
        $sql = 
        "
        Select * from mouse 
        Inner Join external_location on mouse.id = external_location.mouse_id
        Where mouse.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

      }
}
