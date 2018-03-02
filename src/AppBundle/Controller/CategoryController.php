<?php

namespace AppBundle\Controller;

use AppBundle\Manager\CategoryManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /** @var CategoryManager */
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function indexAction()
    {
        $categories = $this->categoryManager->getCategories();

        return $this->render('categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
