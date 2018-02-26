<?php

namespace AppBundle\Controller;

use AppBundle\Service\SeasonManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonController extends Controller
{
    /** @var SeasonManager */
    private $seasonManager;

    public function __construct(SeasonManager $seasonManager)
    {
        $this->seasonManager = $seasonManager;
    }

    /**
     * @Route("/media/tvShow/season/{id}", name="season", requirements={"id"="\d+"})
     */
    public function indexAction(int $id)
    {
        $season = $this->seasonManager->getSeason($id);
        return $this->render('media/tvShow.html.twig', [
            'season' => $season
        ]);
    }
}
