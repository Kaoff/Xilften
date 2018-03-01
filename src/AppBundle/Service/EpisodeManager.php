<?php
/**
 * Created by PhpStorm.
 * User: weber
 * Date: 23/02/2018
 * Time: 14:16
 */

namespace AppBundle\Service;


use AppBundle\Entity\Episode;
use AppBundle\Entity\Season;
use Doctrine\ORM\EntityManagerInterface;

class EpisodeManager
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getEpisode(int $id)
    {
        return $this->em->getRepository(Episode::class)->find($id);
    }

    public function createEpisode(Season $season, string $title, string $videoLink, string $synopsis)
    {
        $ep = new Episode();

        $number = $season->getEpisodes()->count() + 1;

        $ep->setSeason($season)
            ->setTitle($title)
            ->setVideoLink($videoLink)
            ->setNumber($number)
            ->setSynopsis($synopsis)
            ->setImage("http://placehold.it/400x300.png&text=" . $title);

        $season->addEpisode($ep);

        $this->em->persist($ep);
        $this->em->flush();

        return $ep;
    }
}