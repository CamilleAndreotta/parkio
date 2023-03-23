<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


      public function findExternalLocationWitdhUserId($id){
        
        $sql = "
        SELECT external_location.external_user as user, external_location.email as email, external_location.phone as phone,external_location.id as id, external_location.date_start as date_start, external_location.date_end as date_end, external_location.message as message, external_location.accepted as accepted FROM external_location
        INNER JOIN user ON external_location.user_id = user.id
        WHERE user_id = $id
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchAllAssociative();

      }

      public function findInternalLocationWitdhUserId($id){
        
        $sql = "
        SELECT internal_location.id as id, internal_location.date_start as date_start, internal_location.date_end as date_end, internal_location.information as information, internal_location.accepted as accepted FROM internal_location
        INNER JOIN user ON internal_location.user_id = user.id
        WHERE user_id = $id
        ";

        $dbal = $this->getEntityManager()->getConnection();
        $statement = $dbal->prepare($sql);
        $result = $statement->executeQuery();
        
        return $result->fetchAllAssociative();

      }




}
