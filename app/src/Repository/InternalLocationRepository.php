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


    public function findComputerWithInternalLocationId($id){

        $sql = 
        "
        SELECT computer.id, computer.model, computer.status FROM internal_location 
        INNER JOIN computer ON internal_location.computer_id = computer.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findLaptopWithInternalLocationId($id){

        $sql = 
        "
        SELECT laptop.id, laptop.model, laptop.status FROM internal_location 
        INNER JOIN laptop ON internal_location.laptop_id = laptop.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findMonitorWithInternalLocationId($id){

        $sql = 
        "
        SELECT monitor.id, monitor.model, monitor.status FROM internal_location 
        INNER JOIN monitor ON internal_location.monitor_id = monitor.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findVideoprojectorWithInternalLocationId($id){

        $sql = 
        "
        SELECT videoprojector.id, videoprojector.model, videoprojector.status FROM internal_location 
        INNER JOIN videoprojector ON internal_location.videoprojector_id = videoprojector.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findMouseWithInternalLocationId($id){

        $sql = 
        "
        SELECT mouse.id, mouse.model, mouse.status FROM internal_location 
        INNER JOIN mouse ON internal_location.mouse_id = mouse.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findKeyboardWithInternalLocationId($id){

        $sql = 
        "
        SELECT keyboard.id, keyboard.model, keyboard.status FROM internal_location 
        INNER JOIN keyboard ON internal_location.keyboard_id = keyboard.id 
        WHERE internal_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

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

}
