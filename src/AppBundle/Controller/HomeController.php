<?php

namespace AppBundle\Controller;

use AppBundle\Manager\HomeManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /** @var HomeManager */
    private $homeManager;

    public function __construct(HomeManager $homeManager)
    {
        $this->homeManager = $homeManager;
    }

    /**
     * @Route("/home", name="home")
     */
    public function indexAction()
    {
        $movies = $this->homeManager->getMovies();
        $tvShows = $this->homeManager->getTvShows();
        return $this->render('/home.html.twig', [
            'movies' => $movies,
            'tvShows' => $tvShows
        ]);
    }
}
