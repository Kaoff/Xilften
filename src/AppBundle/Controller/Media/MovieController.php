<?php

namespace AppBundle\Controller\Media;

use AppBundle\Manager\MovieManager;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

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

    /**
     * @Route("/user/add_playlist/movie/{id}", name="user_playlist_movie")
     */
    public function addMovieToPlaylistAction(UserManager $userManager, MovieManager $movieManager, int $id)
    {
        $usr = $this->getUser();
        $movie = $movieManager->getMovie($id);

        $userManager->addMovieToPlaylist($usr, $movie);

        return $this->redirectToRoute('movie', [
            'id' => $movie->getId()
        ]);
    }

    /**
     * @Route("/user/upvote/movie/{id}", name="user_upvote_movie")
     */
    public function upvoteMovieAction(MovieManager $movieManager, int $id)
    {
        $movie = $movieManager->getMovie($id);

        $movieManager->upvoteMovie($movie);

        return $this->redirectToRoute('movie', [
            'id' => $movie->getId()
        ]);
    }
}
