<?php

namespace AppBundle\Controller;

use AppBundle\Service\MediaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EpisodeController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @Route("/media/tvShow/season/episode/{id}", name="episode", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $episode = $this->mediaManager->getEpisode($id);
        return $this->render('media/tvShow.html.twig', [
            'episode' => $episode
        ]);
    }
}
