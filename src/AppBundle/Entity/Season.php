<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Season
 *
 * @ORM\Table(name="season")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeasonRepository")
 */
class Season
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
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Episode", mappedBy="season", cascade={"remove"})
     */
    private $episodes;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TVShow", inversedBy="seasons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tvShow;

//    ********* GET/SET *********

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add episode
     *
     * @param \AppBundle\Entity\Episode $episode
     *
     * @return Season
     */
    public function addEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episodes[] = $episode;

        return $this;
    }

    /**
     * Remove episode
     *
     * @param \AppBundle\Entity\Episode $episode
     */
    public function removeEpisode(\AppBundle\Entity\Episode $episode)
    {
        $this->episodes->removeElement($episode);
    }

    /**
     * Get episodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Set series
     *
     * @param \AppBundle\Entity\TVShow $series
     *
     * @return Season
     */
    public function setSeries(\AppBundle\Entity\TVShow $series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return \AppBundle\Entity\TVShow
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Season
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set tvShow
     *
     * @param \AppBundle\Entity\TVShow $tvShow
     *
     * @return Season
     */
    public function setTvShow(\AppBundle\Entity\TVShow $tvShow)
    {
        $this->tvShow = $tvShow;

        return $this;
    }

    /**
     * Get tvShow
     *
     * @return \AppBundle\Entity\TVShow
     */
    public function getTvShow()
    {
        return $this->tvShow;
    }
}
