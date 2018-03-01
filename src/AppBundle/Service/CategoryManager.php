<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 27/02/2018
 * Time: 10:09
 */

namespace AppBundle\Service;


use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getCategory(int $id)
    {
        return $this->em->getRepository(Category::class)->find($id);
    }

    public function getCategories()
    {
        return $this->em->getRepository(Category::class)->findAll();
    }

    public function createCategory(string $name)
    {
        $category = new Category();

        $category->setName($name);

        $this->em->persist($category);
        $this->em->flush();
    }
}