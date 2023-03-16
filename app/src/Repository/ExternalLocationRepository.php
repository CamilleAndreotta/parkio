<?php

namespace App\Repository;

use App\Entity\ExternalLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExternalLocation>
 *
 * @method ExternalLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalLocation[]    findAll()
 * @method ExternalLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalLocation::class);
    }

    public function add(ExternalLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExternalLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLaptopWithExternalLocationId($id){

        $sql = 
        "
        SELECT laptop.id, laptop.model, laptop.status FROM external_location 
        INNER JOIN laptop ON external_location.laptop_id = laptop.id 
        WHERE external_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

    public function findMouseWithExternalLocationId($id){

        $sql = 
        "
        SELECT mouse.id, mouse.model, mouse.status FROM external_location 
        INNER JOIN mouse ON external_location.mouse_id = mouse.id 
        WHERE external_location.id = $id ;
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchOne();

    }

//    /**
//     * @return ExternalLocation[] Returns an array of ExternalLocation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExternalLocation
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
