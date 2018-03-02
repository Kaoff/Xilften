<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", inversedBy="categories")
     */
    private $movies;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TVShow", inversedBy="categories")
     */
    private $tvShows;
    
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tvShows = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add movie
     *
     * @param \AppBundle\Entity\Movie $movie
     *
     * @return Category
     */
    public function addMovie(\AppBundle\Entity\Movie $movie)
    {
        $this->movies[] = $movie;

        return $this;
    }

    /**
     * Remove movie
     *
     * @param \AppBundle\Entity\Movie $movie
     */
    public function removeMovie(\AppBundle\Entity\Movie $movie)
    {
        $this->movies->removeElement($movie);
    }

    /**
     * Get movies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * Add tvShow
     *
     * @param \AppBundle\Entity\TVShow $tvShow
     *
     * @return Category
     */
    public function addTvShow(\AppBundle\Entity\TVShow $tvShow)
    {
        $this->tvShows[] = $tvShow;

        return $this;
    }

    /**
     * Remove tvShow
     *
     * @param \AppBundle\Entity\TVShow $tvShow
     */
    public function removeTvShow(\AppBundle\Entity\TVShow $tvShow)
    {
        $this->tvShows->removeElement($tvShow);
    }

    /**
     * Get tvShows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTvShows()
    {
        return $this->tvShows;
    }
}
