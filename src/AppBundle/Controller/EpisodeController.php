<?php

namespace AppBundle\Controller;

use AppBundle\Manager\EpisodeManager;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

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

    /**
     * @Route("/user/add_playlist/episode/{id}", name="user_playlist_episode")
     */
    public function addEpisodeToPlaylistAction(Request $request, UserManager $userManager, EpisodeManager $episodeManager, int $id)
    {
        $usr = $this->getUser();
        $episode = $episodeManager->getEpisode($id);

        $userManager->addEpisodeToPlaylist($usr, $episode);

        return $this->redirectToRoute('episode', [
            'id' => $episode->getId()
        ]);
    }
}
