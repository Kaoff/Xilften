<?php

namespace AppBundle\Controller\Media;

use AppBundle\Service\MediaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TVShowController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @Route("/media/tvShow/{id}", name="tvShow", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $tvShow = $this->mediaManager->getTvShow($id);
        return $this->render('media/tvShow.html.twig', [
            'tvShow' => $tvShow,
            'seasons' => $tvShow->getSeasons()
        ]);
    }
}
