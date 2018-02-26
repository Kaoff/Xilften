<?php

namespace AppBundle\Controller;

use AppBundle\Service\MediaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonController extends Controller
{
    /** @var MediaManager */
    private $mediaManager;

    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @Route("/media/tvShow/season/{id}", name="season")
     */
    public function indexAction(int $id)
    {
        $season = $this->mediaManager->getSeason($id);
        return $this->render('media/tvShow.html.twig', [
            'season' => $season
        ]);
    }
}
