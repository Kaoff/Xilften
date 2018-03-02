<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 27/02/2018
 * Time: 14:37
 */

namespace AppBundle\Fixture;


use AppBundle\Manager\PersonManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class PersonFixtures extends Fixture
{
    /** @var PersonManager */
    private $personManager;

    /** @var KernelInterface */
    private $kernel;

    public function __construct(PersonManager $personManager, KernelInterface $kernel)
    {
        $this->personManager = $personManager;
        $this->kernel = $kernel;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir(). '/../import/CSV/personFixtures.csv';
        $csv = fopen($csvUrl, 'r');

        $i = 1;

        while (($personCsv = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            $person = $this->personManager->createPerson($personCsv[0]);
            $this->addReference('person-'.$i, $person);

            ++$i;
        }
    }
}