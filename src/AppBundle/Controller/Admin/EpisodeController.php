<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 01/03/2018
 * Time: 14:03
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Episode;
use AppBundle\Entity\Movie;
use AppBundle\Entity\User;
use AppBundle\Form\EpisodeType;
use AppBundle\Form\MovieType;
use AppBundle\Form\UserCreateType;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\EpisodeManager;
use AppBundle\Manager\MovieManager;
use AppBundle\Manager\SeasonManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends Controller
{
    /**
     * @Route("/admin/seasons/{season}/episodes", name="episode_list")
     */
    public function episodeListAction(SeasonManager $seasonManager, EpisodeManager $episodeManager, int $season)
    {
        $season = $seasonManager->getSeason($season);

        $episodes = $season->getEpisodes();

        return $this->render('admin/tvshows/episodes/list.html.twig', array(
            'episodes' => $episodes
        ));
    }

    /**
     * @Route("/admin/seasons/{season}/episodes/create", name="episode_create")
     */
    public function episodeCreateAction(Request $request, EpisodeManager $episodeManager, SeasonManager $seasonManager, int $season)
    {
        $episode = new Episode();

        $epSeason = $seasonManager->getSeason($season);
        $episode->setSeason($epSeason);

        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $task->setImage('https://img.youtube.com/vi/' . $task->getVideoLink() . '/0.jpg');
            $episodeManager->saveEpisode($task);

            return $this->redirectToRoute('episode_list', [
                'season' => $episode->getSeason()->getId()
            ]);
        }

        return $this->render('admin/tvshows/episodes/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/episodes/edit/{id}", name="episode_edit")
     */
    public function episodeEditAction(Request $request, EpisodeManager $episodeManager, string $id)
    {
        $episode = $episodeManager->getEpisode($id);

        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $episodeManager->saveEpisode($task);

            return $this->redirectToRoute('episode_list', [
                'season' => $episode->getSeason()->getId()
            ]);
        }

        return $this->render('admin/tvshows/episodes/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/episodes/delete/{id}", name="episode_delete")
     */
    public function movieDeleteAction(Request $request, EpisodeManager $episodeManager, string $id)
    {
        $episode = $episodeManager->getEpisode($id);

        $episodeManager->deleteEpisode($episode);

        return $this->redirectToRoute('episode_list', [
            'season' => $episode->getSeason()->getId()
        ]);

    }
}