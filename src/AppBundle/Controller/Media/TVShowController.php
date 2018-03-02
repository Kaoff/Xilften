<?php

namespace AppBundle\Controller\Media;

use AppBundle\Manager\TvShowManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TVShowController extends Controller
{
    /** @var TvShowManager */
    private $tvShowManager;

    public function __construct(TvShowManager $tvShowManager)
    {
        $this->tvShowManager = $tvShowManager;
    }

    /**
     * @Route("/media/tvShow/{id}", name="tvShow", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $tvShow = $this->tvShowManager->getTvShow($id);
        return $this->render('media/tvShow.html.twig', [
            'tvShow' => $tvShow,
            'seasons' => $tvShow->getSeasons()
        ]);
    }

    /**
     * @Route("/user/upvote/tvshow/{id}", name="user_tvshow_episode")
     */
    public function upvoteTvshowAction(TvShowManager $tvShowManager, int $id)
    {
        $tvShow = $tvShowManager->getTvShow($id);

        $tvShowManager->upvoteTvShow($tvShow);

        return $this->redirectToRoute('tvShow', [
            'id' => $tvShow->getId()
        ]);
    }
}
