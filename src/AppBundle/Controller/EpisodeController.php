<?php

namespace AppBundle\Controller;

use AppBundle\Service\EpisodeManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EpisodeController extends Controller
{
    /** @var EpisodeManager */
    private $episodeManager;

    public function __construct(EpisodeManager $episodeManager)
    {
        $this->episodeManager = $episodeManager;
    }

    /**
     * @Route("/media/tvShow/season/episode/{id}", name="episode", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $episode = $this->episodeManager->getEpisode($id);
        return $this->render('media/tvShow.html.twig', [
            'episode' => $episode
        ]);
    }
}
