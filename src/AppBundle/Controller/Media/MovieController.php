<?php

namespace AppBundle\Controller\Media;

use AppBundle\Service\MovieManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    /** @var MovieManager */
    private $movieManager;

    public function __construct(MovieManager $movieManager)
    {
        $this->movieManager = $movieManager;
    }

    /**
     * @Route("/media/movie/{id}", name="movie", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $movie = $this->movieManager->getMovie($id);
        return $this->render('media/movie.html.twig', [
            'movie' => $movie
        ]);
    }
}
