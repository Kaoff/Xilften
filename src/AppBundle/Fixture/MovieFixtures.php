<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 26/02/2018
 * Time: 10:37
 */

namespace AppBundle\Fixture;

use AppBundle\Entity\Person;
use AppBundle\Manager\MovieManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var KernelInterface */
    private $kernel;

    /** @var MovieManager */
    private $mediaManager;

    public function __construct(KernelInterface $kernel, MovieManager $mediaManager)
    {
        $this->kernel = $kernel;
        $this->mediaManager = $mediaManager;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir(). '/../import/CSV/movieFixtures.csv';
        $csv = fopen($csvUrl, 'r');

        while (($movieCsv = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            $movie = $this->mediaManager->createMovie($movieCsv[0], $movieCsv[1], 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');

            $r = random_int(1, 5);
            for ($i = 1; $i < $r; ++$i)
            {
                $this->mediaManager->addActor($movie, $this->getReference('person-'.$i));
            }

            $r = random_int(1, 3);
            for ($j = 1; $j < $r; ++$j)
            {
                $this->mediaManager->addDirector($movie, $this->getReference('person-'.$j));
            }
        }
    }

    function getDependencies()
    {
        return array(
            PersonFixtures::class
        );
    }
}