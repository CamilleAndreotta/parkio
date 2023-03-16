<?php

namespace App\Repository;

use App\Entity\Videoprojector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Videoprojector>
 *
 * @method Videoprojector|null find($id, $lockMode = null, $lockVersion = null)
 * @method Videoprojector|null findOneBy(array $criteria, array $orderBy = null)
 * @method Videoprojector[]    findAll()
 * @method Videoprojector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoprojectorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Videoprojector::class);
    }

    public function add(Videoprojector $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Videoprojector $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Videoprojector[] Returns an array of Videoprojector objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Videoprojector
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

       /**
       * Find Internal Relation for videoprojector
       *
       * @param [type] $id
       * @return array
       */
      public function findVideoprojectorAndInternalLocation($id){
        
        $sql = 
        "
        Select * from videoprojector
        Inner Join internal_location on videoprojector.id = internal_location.videoprojector_id
        Where videoprojector.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

      }
}
