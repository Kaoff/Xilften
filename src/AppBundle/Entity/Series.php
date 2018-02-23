<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeriesRepository")
 */
class Series
{
    use Media;

    /**
     * @ORM\OneToMany(targetEntity="Season", mappedBy="series")
     */
    private $seasons;

//    ********* GET/SET *********

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seasons = new ArrayCollection();
    }

    /**
     * Add season
     *
     * @param Season $season
     *
     * @return Series
     */
    public function addSeason(Season $season)
    {
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param Season $season
     */
    public function removeSeason(\AppBundle\Entity\Season $season)
    {
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return Collection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
}
