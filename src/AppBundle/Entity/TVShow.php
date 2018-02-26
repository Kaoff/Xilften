<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TVShow
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeriesRepository")
 */
class TVShow
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text")
     */
    private $synopsis;

    /**
     * @ORM\OneToMany(targetEntity="Season", mappedBy="tvShow")
     */
    private $seasons;

    /**
     * @var int
     *
     * @ORM\Column(name="upvotes", type="integer")
     */
    private $upvotes;

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
     * @return TVShow
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

    /**
     * Set title
     *
     * @param string $title
     *
     * @return TVShow
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     *
     * @return TVShow
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set upvotes
     *
     * @param integer $upvotes
     *
     * @return TVShow
     */
    public function setUpvotes($upvotes)
    {
        $this->upvotes = $upvotes;
        return $this;
    }
    /**
     * Get upvotes
     *
     * @return int
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
