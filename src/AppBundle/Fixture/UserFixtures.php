<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 11:18
 */

namespace AppBundle\Fixture;

use AppBundle\Entity\User;
use AppBundle\Service\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;

class UserFixtures extends Fixture
{
    /** @var KernelInterface */
    private $kernel;

    /** @var UserManager */
    private $userManager;

    public function __construct(KernelInterface $kernel, UserManager $userManager)
    {
        $this->kernel = $kernel;
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir() . '/../import/CSV/userFixtures.csv';
        $csv = fopen($csvUrl, "r");

        while(($user = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            $email = $user[0];
            $fullname = $user[1];
            $password = $user[2];
            $avatar = $user[3];
            $isAdmin = $user[4];

            $this->userManager->createUser($email, $password, $fullname, $avatar, $isAdmin);
        }
    }
}