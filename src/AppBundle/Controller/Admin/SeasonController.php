<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 01/03/2018
 * Time: 14:03
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Movie;
use AppBundle\Entity\TVShow;
use AppBundle\Entity\User;
use AppBundle\Form\MovieType;
use AppBundle\Form\TVShowType;
use AppBundle\Form\UserCreateType;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\MovieManager;
use AppBundle\Manager\SeasonManager;
use AppBundle\Manager\TvShowManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SeasonController extends Controller
{
    /**
     * @Route("/admin/tvshows/{show}/seasons", name="season_list")
     */
    public function seasonListAction(SeasonManager $seasonManager, TvShowManager $tvShowManager, int $show)
    {
        $tvshow = $tvShowManager->getTvShow($show);
        $seasons = $tvshow->getSeasons();

        return $this->render('admin/tvshows/seasons/list.html.twig', array(
            'seasons' => $seasons
        ));
    }

    /**
     * @Route("/admin/tvshows/{show}/seasons/create", name="season_create")
     */
    public function seasonCreateAction(Request $request, TvShowManager $tvshowManager, SeasonManager $seasonManager, int $show)
    {
        $tvshow = $tvshowManager->getTvShow($show);
        $seasonManager->createSeason($show);

        return $this->redirectToRoute('season_list');
    }

    /**
     * @Route("/admin/seasons/delete/{id}", name="season_delete")
     */
    public function seasonDeleteAction(Request $request, SeasonManager $seasonManager, int $show, int $id)
    {
        $season = $seasonManager->getSeason($id);

        $seasonManager->deleteSeason($season);
        return $this->redirectToRoute('season_list', array(
            'show' => $show
        ));
    }
}