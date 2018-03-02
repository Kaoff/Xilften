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
     * @Route("/category", name="category")
     */
    public function indexAction()
    {
        $movies = $this->categoryManager->getMovies();
        $tvShows = $this->categoryManager->getTvShows();
        return $this->render('/home.html.twig', [
            'movies' => $movies,
            'tvShows' => $tvShows
        ]);
    }
}
