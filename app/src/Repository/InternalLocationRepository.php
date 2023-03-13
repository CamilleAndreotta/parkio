<?php

namespace App\Repository;

use App\Entity\InternalLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InternalLocation>
 *
 * @method InternalLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternalLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternalLocation[]    findAll()
 * @method InternalLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternalLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternalLocation::class);
    }

    public function add(InternalLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InternalLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InternalLocation[] Returns an array of InternalLocation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InternalLocation
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
      
      /**
       * Method for find laptop in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithLaptop($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_laptop on internal_location.id = internal_location_laptop.internal_location_id
        inner join laptop On laptop.id = internal_location_laptop.laptop_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

      /**
       * Method for find computer in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithComputer($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_computer on internal_location.id = internal_location_computer.internal_location_id
        inner join computer On computer.id = internal_location_computer.computer_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

      /**
       * Method for find monitor in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithMonitor($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_monitor on internal_location.id = internal_location_monitor.internal_location_id
        inner join monitor On monitor.id = internal_location_monitor.monitor_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

      /**
       * Method for find videoprojector in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithVideoprojector($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_videoprojector on internal_location.id = internal_location_videoprojector.internal_location_id
        inner join videoprojector On videoprojector.id = internal_location_videoprojector.videoprojector_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

      /**
       * Method for find mouse in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithMouse($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_mouse on internal_location.id = internal_location_mouse.internal_location_id
        inner join mouse On mouse.id = internal_location_mouse.mouse_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

      /**
       * Method for find computer in internal location. Use to change value of status
       *
       * @param [type] $id
       * @return array
       */
      public function findInternalLocationWithKeyboard($id){
        
        $sql = "
        Select * from internal_location
        inner join internal_location_keyboard on internal_location.id = internal_location_keyboard.internal_location_id
        inner join keyboard On keyboard.id = internal_location_keyboard.keyboard_id
        Where internal_location.id = $id ";

        $dbal = $this->getEntityManager()->getConnection(); 
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    
      }

}
