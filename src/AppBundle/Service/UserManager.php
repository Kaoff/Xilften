<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 11:14
 */

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var UserPasswordEncoderInterface  */
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getUser(int $id)
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    public function getUsers()
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function createUser(string $email, string $password, string $fullname, string $avatar, bool $isAdmin)
    {
        $u = new User();

        $encPassword = $this->passwordEncoder->encodePassword($u, $password);
        $u->setEmail($email)
            ->setPassword($encPassword)
            ->setAvatar($avatar)
            ->setFullname($fullname)
            ->setRoles(($isAdmin ? ['ROLE_ADMIN', 'ROLE_USER'] : ['ROLE_USER']));

        $this->em->persist($u);
        $this->em->flush();
    }
}