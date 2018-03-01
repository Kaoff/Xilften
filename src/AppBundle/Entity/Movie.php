<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
{
    use Media;

    /**
     * @var int
     *
     * @ORM\Column(name="upvotes", type="integer")
     */
    private $upvotes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Person", mappedBy="moviesAsActor")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Person", mappedBy="moviesAsDirector")
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
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set upvotes
     *
     * @param integer $upvotes
     *
     * @return Movie
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
     * Add actor
     *
     * @param \AppBundle\Entity\Person $actor
     *
     * @return Movie
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
     * @return Movie
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
     * @return Movie
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
     * @return Movie
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
