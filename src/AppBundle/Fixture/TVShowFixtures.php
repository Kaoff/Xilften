<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 15:09
 */

namespace AppBundle\Fixture;


use AppBundle\Entity\TVShow;
use AppBundle\Service\TvShowManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class TVShowFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var TvShowManager */
    private $showManager;

    /** @var KernelInterface */
    private $kernel;

    public function __construct(TvShowManager $showManager, KernelInterface $kernel)
    {
        $this->showManager = $showManager;
        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir() . '/../import/CSV/tvShowFixtures.csv';
        $csv = fopen($csvUrl, "r");

        $i = 0;
        while(($showCsv = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            $title = $showCsv[0];
            $synopsis = $showCsv[1];

            $show = $this->showManager->createTvShow($title, $synopsis);
            $this->addReference('tvshow-'.$i, $show);

            $r = random_int(1, 5);
            for ($j = 1; $j < $r; ++$j)
            {
                $this->showManager->addActor($show, $this->getReference('person-'.$j));
            }

            $r = random_int(1, 3);
            for ($j = 1; $j < $r; ++$j)
            {
                $this->showManager->addDirector($show, $this->getReference('person-'.$j));
            }

            $i++;
        }
    }

    function getDependencies()
    {
        return array(
            PersonFixtures::class
        );
    }
}