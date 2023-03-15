<?php

namespace App\Repository;

use App\Entity\Keyboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Keyboard>
 *
 * @method Keyboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Keyboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Keyboard[]    findAll()
 * @method Keyboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Keyboard::class);
    }

    public function add(Keyboard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Keyboard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Keyboard[] Returns an array of Keyboard objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Keyboard
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
/**
       * Find Internal Relation for keyboard
       *
       * @param [type] $id
       * @return array
       */
      public function findKeyboardAndInternalLocation($id){
        
        $sql = 
        "
        Select * from keyboard
        Inner Join internal_location_keyboard on keyboard.id = internal_location_keyboard.keyboard_id
        Where keyboard.id = $id;
        ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();

      }
}
