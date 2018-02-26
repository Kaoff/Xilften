<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 26/02/2018
 * Time: 10:37
 */

namespace AppBundle\Fixture;


use AppBundle\Service\MediaManager;
use AppBundle\Service\MovieManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class MovieFixtures extends Fixture
{
    /** @var KernelInterface */
    private $kernel;

    /** @var MediaManager */
    private $mediaManager;

    public function __construct(KernelInterface $kernel, MediaManager $mediaManager)
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
            $this->mediaManager->createMovie($movieCsv[0], $movieCsv[1], 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        }
    }
}