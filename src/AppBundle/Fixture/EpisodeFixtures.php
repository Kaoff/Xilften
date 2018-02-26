<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 14:14
 */

namespace AppBundle\Fixture;


use AppBundle\Entity\Episode;
use AppBundle\Service\EpisodeManager;
use AppBundle\Service\TvShowManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var KernelInterface */
    private $kernel;

    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(KernelInterface $kernel, EpisodeManager $episodeManager)
    {
        $this->kernel = $kernel;
        $this->episodeManager = $episodeManager;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir() . '/../import/CSV/episodeNames.csv';
        $csv = fopen($csvUrl, "r");
        $episodeNames = array();

        while(($showCsv = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            array_push($episodeNames, $showCsv[0]);
        }

        for($i = 0; $i < 20; ++$i) {

            $nbSeasons = $this->getReference('tvshow-' . $i)->getSeasons()->count();

            for ($j = 0; $j < $nbSeasons; ++$j)
            {
                for ($k = 0; $k < 12; ++$k)
                {
                    $season = $this->getReference('tvshow-'.$i.'season-'.$j);
                    $this->episodeManager->createEpisode($season, $episodeNames[random_int(0, 999)],'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'Ceci est un synopsis (oui).');
                }
            }
        }
    }

    function getDependencies()
    {
        return array(
            SeasonFixtures::class,
        );
    }
}