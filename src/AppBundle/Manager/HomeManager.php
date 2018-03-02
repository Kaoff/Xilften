<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 26/02/2018
 * Time: 15:17
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Movie;
use AppBundle\Entity\TVShow;
use Doctrine\ORM\EntityManagerInterface;

class HomeManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getMovies()
    {
        return $this->em->getRepository(Movie::class)->findAll();
    }

    public function getTvShows()
    {
        return $this->em->getRepository(TVShow::class)->findAll();
    }
}