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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TVShowRepository")
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
     * @ORM\OneToMany(targetEntity="Season", mappedBy="tvShow", cascade={"remove"})
     */
    private $seasons;

    /**
     * @var int
     *
     * @ORM\Column(name="upvotes", type="integer")
     */
    private $upvotes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Person", mappedBy="tvShowsAsActor")
     * @ORM\JoinTable(name="actor_tvshow")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", mappedBy="tvShows")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Person", mappedBy="tvShowsAsDirector")
     * @ORM\JoinTable(name="director_tvshow")
     */
    private $directors;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seasons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return integer
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Add season
     *
     * @param \AppBundle\Entity\Season $season
     *
     * @return TVShow
     */
    public function addSeason(\AppBundle\Entity\Season $season)
    {
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \AppBundle\Entity\Season $season
     */
    public function removeSeason(\AppBundle\Entity\Season $season)
    {
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * Add actor
     *
     * @param \AppBundle\Entity\Person $actor
     *
     * @return TVShow
     */
    public function addActor(\AppBundle\Entity\Person $actor)
    {
        $this->actors[] = $actor;

        return $this;
    }

    /**
     * Remove actor
     *
     * @param \AppBundle\Entity\Person $actor
     */
    public function removeActor(\AppBundle\Entity\Person $actor)
    {
        $this->actors->removeElement($actor);
    }

    /**
     * Get actors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return TVShow
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add director
     *
     * @param \AppBundle\Entity\Person $director
     *
     * @return TVShow
     */
    public function addDirector(\AppBundle\Entity\Person $director)
    {
        $this->directors[] = $director;

        return $this;
    }

    /**
     * Remove director
     *
     * @param \AppBundle\Entity\Person $director
     */
    public function removeDirector(\AppBundle\Entity\Person $director)
    {
        $this->directors->removeElement($director);
    }

    /**
     * Get directors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return TVShow
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
