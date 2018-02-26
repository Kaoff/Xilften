<?php

namespace AppBundle\Controller;

use AppBundle\Service\MediaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @Route("/media/movie/{id}", name="movie")
     */
    public function indexAction(int $id)
    {
        $movie = $this->mediaManager->getMovie($id);
        return $this->render('media/movie.html.twig', [
            'movie' => $movie
        ]);
    }
}
