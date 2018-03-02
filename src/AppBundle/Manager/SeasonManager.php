<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 15:55
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Season;
use AppBundle\Entity\TVShow;
use Doctrine\ORM\EntityManagerInterface;

class SeasonManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getSeason($id)
    {
       return $this->em->getRepository(Season::class)->find($id);
    }

    public function getSeasons()
    {
        return $this->em->getRepository(Season::class)->findAll();
    }

    public function deleteSeason($season)
    {
        $this->em->remove($season);
        $this->em->flush();
    }

    /** @return Season */
    public function createSeason(TVShow &$show)
    {
        $number = $show->getSeasons()->count() + 1;
        $season = new Season();
        $season->setNumber($number);
        $season->setTvShow($show);
        $show->addSeason($season);

        $this->em->persist($season);
        $this->em->flush();

        return $season;
    }
}