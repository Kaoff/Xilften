<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 26/02/2018
 * Time: 14:23
 */

namespace AppBundle\Service;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class MovieManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getMovie($id)
    {
        return $this->em->getRepository(Movie::class)->find($id);
    }

    public function getMovies()
    {
        return $this->em->getRepository(Movie::class)->findAll();
    }

    public function createMovie(string $title, string $synopsis, string $videoLink)
    {
        $mov = new Movie();

        $mov->setTitle($title)
            ->setVideoLink($videoLink)
            ->setSynopsis($synopsis)
            ->setUpvotes(0)
            ->setImage("http://placehold.it/400x300.png&text=" . $title);

        $this->em->persist($mov);
        $this->em->flush();

        return $mov;
    }

    public function upvoteMovie(Movie $movie)
    {
        $current = $movie->getUpvotes();

        $movie->setUpvotes($current + 1);

        $this->em->persist($movie);
        $this->em->flush();

        return $movie;
    }

    public function editMovie(Movie $movie)
    {
        $this->em->persist($movie);
        $this->em->flush();
    }

    public function addActor(Movie $movie, Person $actor)
    {
        $actor->addMoviesAsActor($movie);

        $this->em->persist($actor);
        $this->em->flush();
    }

    public function addDirector(Movie $movie, Person $director)
    {
        $director->addMoviesAsDirector($movie);

        $this->em->persist($director);
        $this->em->flush();
    }
}