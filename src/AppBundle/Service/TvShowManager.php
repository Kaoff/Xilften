<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 14:52
 */

namespace AppBundle\Service;


use AppBundle\Entity\Movie;
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
            ->setUpvotes(0);

        $this->em->persist($show);
        $this->em->flush();

        return $show;
    }
}