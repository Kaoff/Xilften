<?php

namespace AppBundle\Controller;

use AppBundle\Manager\EpisodeManager;
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
     * @Route("/media/tvShow/episode/{id}", name="episode", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $episode = $this->episodeManager->getEpisode($id);
        return $this->render('media/episode.html.twig', [
            'episode' => $episode,
            'nextEpisode' => $this->episodeManager->getNextEpisode($episode)
        ]);
    }
}
