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
     * @return int
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }
}
