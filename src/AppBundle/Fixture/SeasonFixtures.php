<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 15:55
 */

namespace AppBundle\Fixture;


use AppBundle\Manager\SeasonManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var SeasonManager */
    private $seasonManager;

    public function __construct(SeasonManager $seasonManager)
    {
        $this->seasonManager = $seasonManager;
    }

    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20; ++$i) {
            for ($j = 0; $j < random_int(1, 5); ++$j)
            {
                $show = $this->getReference('tvshow-'.$i);
                $season = $this->seasonManager->createSeason($show);
                $this->addReference('tvshow-'. $i . 'season-' . $j, $season);
            }
        }
    }

    function getDependencies()
    {
        return array(
            TVShowFixtures::class
        );
    }
}