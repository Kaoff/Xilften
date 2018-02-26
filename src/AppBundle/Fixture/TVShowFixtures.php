<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 15:09
 */

namespace AppBundle\Fixture;


use AppBundle\Entity\TVShow;
use AppBundle\Service\MediaManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class TVShowFixtures extends Fixture
{
    /** @var MediaManager */
    private $showManager;

    /** @var KernelInterface */
    private $kernel;

    public function __construct(MediaManager $showManager, KernelInterface $kernel)
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

            $i++;
        }
    }
}