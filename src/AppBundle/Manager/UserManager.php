<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 11:14
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Episode;
use AppBundle\Entity\Movie;
use AppBundle\Entity\TVShow;
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

    public function createUser(string $email, string $password, string $avatar, string $fullname, bool $isAdmin)
    {
        $u = new User();

        $encPassword = $this->passwordEncoder->encodePassword($u, $password);
        $u->setEmail($email)
            ->setPassword($encPassword)
            ->setAvatar($avatar)
            ->setFullname($fullname)
            ->setIsAdmin($isAdmin)
            ->setRoles(($isAdmin ? ['ROLE_ADMIN', 'ROLE_USER'] : ['ROLE_USER']));

        $this->em->persist($u);
        $this->em->flush();
    }

    public function addMovieToPlaylist(User $user, Movie $movie)
    {
        $user->addMoviePlaylist($movie);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function addMovieToSeen(User $user, Movie $movie)
    {
        $user->addSeenMovie($movie);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function addEpisodeToSeen(User $user, Episode $episode)
    {
        $user->addSeenEpisode($episode);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function addEpisodeToPlaylist(User $user, Episode $episode)
    {
        $user->addEpisodePlaylist($episode);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function registerUserData(User $user)
    {
        $encPassword = $this->passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($encPassword)
            ->setIsAdmin(false)
            ->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();
    }
}
