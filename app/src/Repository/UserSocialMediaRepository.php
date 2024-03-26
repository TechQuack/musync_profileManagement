<?php

namespace App\Repository;

use App\Entity\UserSocialMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSocialMedia>
 *
 * @method UserSocialMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSocialMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSocialMedia[]    findAll()
 * @method UserSocialMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSocialMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSocialMedia::class);
    }

    //    /**
    //     * @return UserSocialMedia[] Returns an array of UserSocialMedia objects
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

    //    public function findOneBySomeField($value): ?UserSocialMedia
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
