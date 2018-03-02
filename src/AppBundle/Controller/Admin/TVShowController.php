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
use AppBundle\Manager\TvShowManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TVShowController extends Controller
{
    /**
     * @Route("/admin/tvshows", name="tvshow_list")
     */
    public function tvShowListAction(TvShowManager $tvshowManager)
    {
        $tvShows = $tvshowManager->getTvShows();

        return $this->render('admin/tvshows/list.html.twig', array(
            'tvShows' => $tvShows
        ));
    }

    /**
     * @Route("/admin/tvshows/create", name="tvshow_create")
     */
    public function tvShowCreateAction(Request $request, TvShowManager $tvshowManager)
    {
        $tvshow = new TVShow();

        $form = $this->createForm(TVShowType::class, $tvshow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $tvshowManager->saveTvShow($task);

            return $this->redirectToRoute('tvshow_list');
        }

        return $this->render('admin/tvshows/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/tvshows/edit/{id}", name="tvshow_edit")
     */
    public function tvShowEditAction(Request $request, TvShowManager $tvshowManager, string $id)
    {
        $tvshow = $tvshowManager->getTvShow($id);

        $form = $this->createForm(TVShowType::class, $tvshow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $tvshowManager->saveTvShow($task);

            return $this->redirectToRoute('tvshow_list');
        }

        return $this->render('admin/tvshows/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/tvshows/delete/{id}", name="tvshow_delete")
     */
    public function tvShowDeleteAction(Request $request, TvShowManager $tvshowManager, string $id)
    {
        $tvshow = $tvshowManager->getTvShow($id);

        $tvshowManager->deleteTvShow($tvshow);

        return $this->redirectToRoute('tvshow_list');
    }
}