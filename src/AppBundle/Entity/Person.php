<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", inversedBy="actors")
     * @ORM\JoinTable(name="actor_movie")
     */
    private $moviesAsActor;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", inversedBy="directors")
     * @ORM\JoinTable(name="director_movie")
     */
    private $moviesAsDirector;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TVShow", inversedBy="actors")
     * @ORM\JoinTable(name="actor_tvshow")
     */
    private $tvShowsAsActor;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TVShow", inversedBy="directors")
     * @ORM\JoinTable(name="director_tvshow")
     */
    private $tvShowsAsDirector;
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
     * Set fullname
     *
     * @param string $fullname
     *
     * @return Person
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
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
     * @return Person
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
     * @return Person
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

    /**
     * Add moviesAsActor
     *
     * @param \AppBundle\Entity\Movie $moviesAsActor
     *
     * @return Person
     */
    public function addMoviesAsActor(\AppBundle\Entity\Movie $moviesAsActor)
    {
        $this->moviesAsActor[] = $moviesAsActor;

        return $this;
    }

    /**
     * Remove moviesAsActor
     *
     * @param \AppBundle\Entity\Movie $moviesAsActor
     */
    public function removeMoviesAsActor(\AppBundle\Entity\Movie $moviesAsActor)
    {
        $this->moviesAsActor->removeElement($moviesAsActor);
    }

    /**
     * Get moviesAsActor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoviesAsActor()
    {
        return $this->moviesAsActor;
    }

    /**
     * Add moviesAsDirector
     *
     * @param \AppBundle\Entity\Movie $moviesAsDirector
     *
     * @return Person
     */
    public function addMoviesAsDirector(\AppBundle\Entity\Movie $moviesAsDirector)
    {
        $this->moviesAsDirector[] = $moviesAsDirector;

        return $this;
    }

    /**
     * Remove moviesAsDirector
     *
     * @param \AppBundle\Entity\Movie $moviesAsDirector
     */
    public function removeMoviesAsDirector(\AppBundle\Entity\Movie $moviesAsDirector)
    {
        $this->moviesAsDirector->removeElement($moviesAsDirector);
    }

    /**
     * Get moviesAsDirector
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoviesAsDirector()
    {
        return $this->moviesAsDirector;
    }

    /**
     * Add tvShowsAsActor
     *
     * @param \AppBundle\Entity\TVShow $tvShowsAsActor
     *
     * @return Person
     */
    public function addTvShowsAsActor(\AppBundle\Entity\TVShow $tvShowsAsActor)
    {
        $this->tvShowsAsActor[] = $tvShowsAsActor;

        return $this;
    }

    /**
     * Remove tvShowsAsActor
     *
     * @param \AppBundle\Entity\TVShow $tvShowsAsActor
     */
    public function removeTvShowsAsActor(\AppBundle\Entity\TVShow $tvShowsAsActor)
    {
        $this->tvShowsAsActor->removeElement($tvShowsAsActor);
    }

    /**
     * Get tvShowsAsActor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTvShowsAsActor()
    {
        return $this->tvShowsAsActor;
    }

    /**
     * Add tvShowsAsDirector
     *
     * @param \AppBundle\Entity\TVShow $tvShowsAsDirector
     *
     * @return Person
     */
    public function addTvShowsAsDirector(\AppBundle\Entity\TVShow $tvShowsAsDirector)
    {
        $this->tvShowsAsDirector[] = $tvShowsAsDirector;

        return $this;
    }

    /**
     * Remove tvShowsAsDirector
     *
     * @param \AppBundle\Entity\TVShow $tvShowsAsDirector
     */
    public function removeTvShowsAsDirector(\AppBundle\Entity\TVShow $tvShowsAsDirector)
    {
        $this->tvShowsAsDirector->removeElement($tvShowsAsDirector);
    }

    /**
     * Get tvShowsAsDirector
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTvShowsAsDirector()
    {
        return $this->tvShowsAsDirector;
    }
}
