<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($registry, User::class);
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $this->getEntityManager();
    }
    public function registerUser(User $user, $role, $password)
    {
        $password = $this->passwordEncoder->encodePassword($user, $password);

        $user
            ->setPassword($password)
            ->setIsActive(false)
            ->setRoles($role);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
    public function newPassword(User $user, $password)
    {
        if (!empty($user)) {
            $password = $this->passwordEncoder->encodePassword($user, $password);
            $user->setPassword($password);

            $this->entityManager->flush();
        }

        return $user;
    }
    public function activation($hash)
    {
        /** @var User $user */
        $user = $this->findOneBy(['hash' => $hash]);
        if (!empty($user)) {
            $user
                ->setIsActive(true)
                ->setHash($this->generateHash($user));

            $this->entityManager->flush();
        }

        return $user;
    }
    public function generateHash(User $user)
    {
        return sha1(implode('-', [time(), $user->getEmail()]));
    }
    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getDirectoryFromEmail($email){
        return explode('@',$email)[0];
    }
}

