<?php

namespace AppBundle\Controller;

use AppBundle\Service\MediaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @Route("/home", name="home")
     */
    public function indexAction()
    {
        $movies = $this->mediaManager->getMovies();
        $tvShows = $this->mediaManager->getTvShows();
        return $this->render('/home.html.twig', [
            'movies' => $movies,
            'tvShows' => $tvShows
        ]);
    }
}
