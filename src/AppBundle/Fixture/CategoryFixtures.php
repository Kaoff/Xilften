<?php

namespace AppBundle\Fixture;

use AppBundle\Manager\CategoryManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class CategoryFixtures extends Fixture
{
    /** @var KernelInterface */
    private $kernel;

    /** @var CategoryManager */
    private $categoryManager;

    public function __construct(KernelInterface $kernel, CategoryManager $categoryManager)
    {
        $this->kernel = $kernel;
        $this->categoryManager = $categoryManager;
    }

    public function load(ObjectManager $manager)
    {
        $csvUrl = $this->kernel->getRootDir() . '/../import/CSV/categoryFixtures.csv';
        $csv = fopen($csvUrl, "r");

        while(($category = fgetcsv($csv, 1000, ',')) !== FALSE)
        {
            $name = $category[0];

            $this->categoryManager->createCategory($name);
        }
    }
}