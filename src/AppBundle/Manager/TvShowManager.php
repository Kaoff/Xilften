<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 14:52
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Person;
use AppBundle\Entity\Season;
use AppBundle\Entity\TVShow;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class TvShowManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getTvShow($id)
    {
        return $this->em->getRepository(TVShow::class)->find($id);
    }

    public function getTvShows()
    {
        return $this->em->getRepository(TVShow::class)->findAll();
    }

    public function createTvShow(string $title, string $synopsis)
    {
        $show = new TVShow();
        $show->setTitle($title)
            ->setSynopsis($synopsis)
            ->setUpvotes(0)
            ->setImage("http://placehold.it/400x300.png&text=" . $title);

        $this->em->persist($show);
        $this->em->flush();

        return $show;
    }

    public function saveTvShow(TVShow $tvshow)
    {
        $this->em->persist($tvshow);
        $this->em->flush();
    }

    public function deleteTvShow(TVShow $tvshow)
    {
        $this->em->remove($tvshow);
        $this->em->flush();
    }

    public function addActor(TVShow $tvshow, Person $actor)
    {
        $actor->addTvShowsAsActor($tvshow);

        $this->em->persist($actor);
        $this->em->flush();
    }

    public function addDirector(TVShow $tvshow, Person $director)
    {
        $director->addTvShowsAsDirector($tvshow);

        $this->em->persist($director);
        $this->em->flush();
    }

    public function upvoteTvShow(TVShow $tvshow)
    {
        $current = $tvshow->getUpvotes();

        $tvshow->setUpvotes($current + 1);

        $this->em->persist($tvshow);
        $this->em->flush();

        return $tvshow;
    }
}