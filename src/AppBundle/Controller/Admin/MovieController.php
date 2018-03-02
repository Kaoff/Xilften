<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 01/03/2018
 * Time: 14:03
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Movie;
use AppBundle\Entity\User;
use AppBundle\Form\MovieType;
use AppBundle\Form\UserCreateType;
use AppBundle\Form\UserEditType;
use AppBundle\Manager\MovieManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
{
    /**
     * @Route("/admin/movies", name="movie_list")
     */
    public function movieListAction(MovieManager $movieManager)
    {
        $movies = $movieManager->getMovies();

        return $this->render('admin/movies/list.html.twig', array(
            'movies' => $movies
        ));
    }

    /**
     * @Route("/admin/movies/create", name="movie_create")
     */
    public function movieCreateAction(Request $request, MovieManager $movieManager)
    {
        $movie = new Movie();
        $movie->setUpvotes(0);

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $task->setImage('https://img.youtube.com/vi/' . $task->getVideoLink() . '/0.jpg');
            $movieManager->saveMovie($task);

            return $this->redirectToRoute('movie_list');
        }

        return $this->render('admin/movies/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/movies/edit/{id}", name="movie_edit")
     */
    public function movieEditAction(Request $request, MovieManager $movieManager, string $id)
    {
        $movie = $movieManager->getMovie($id);

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $movieManager->saveMovie($task);

            return $this->redirectToRoute('movie_list');
        }

        return $this->render('admin/movies/edit.html.twig', array(
            'movie' => $movie,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/movies/delete/{id}", name="movie_delete")
     */
    public function movieDeleteAction(Request $request, MovieManager $movieManager, string $id)
    {
        $movie = $movieManager->getMovie($id);

        $movieManager->deleteMovie($movie);

        return $this->redirectToRoute('movie_list');
    }
}