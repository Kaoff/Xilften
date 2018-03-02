<?php

namespace AppBundle\Entity;

use AppBundle\Traits\Media;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
     */
    private $avatar;

    /** @var boolean
     *
     * @ORM\Column(name="isAdmin", type="boolean", nullable=false)
     */
    private $isAdmin;

    /**
     * @var array
     *
     *  @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", cascade={"remove"})
     */
    private $seenMovies;

    /**
     * @var array
     *
     *  @ORM\ManyToMany(targetEntity="AppBundle\Entity\Episode", cascade={"remove"})
     */
    private $seenEpisode;

    /**
     * @var array
     *
     *  @ORM\ManyToMany(targetEntity="AppBundle\Entity\TVShow", cascade={"remove"})
     */
    private $seenTvShow;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", cascade={"remove"})
     * @ORM\JoinTable(name="user_movie_playlist")
     */
    private $moviePlaylist;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Episode", cascade={"remove"})
     * @ORM\JoinTable(name="user_episode_playlist")
     */
    private $episodePlaylist;

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        $roles = array('ROLE_USER');

        if ($this->isAdmin)
        {
            array_push($roles, 'ROLE_ADMIN');
        }

        return $roles;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
        return;
    }

    public function getUsername()
    {
        return $this->email;
        // TODO: Implement getUsername() method.
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return User
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
        $this->seenMovies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seenEpisode = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seenTvShow = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add seenMovie
     *
     * @param \AppBundle\Entity\Movie $seenMovie
     *
     * @return User
     */
    public function addSeenMovie(\AppBundle\Entity\Movie $seenMovie)
    {
        $this->seenMovies[] = $seenMovie;

        return $this;
    }

    /**
     * Remove seenMovie
     *
     * @param \AppBundle\Entity\Movie $seenMovie
     */
    public function removeSeenMovie(\AppBundle\Entity\Movie $seenMovie)
    {
        $this->seenMovies->removeElement($seenMovie);
    }

    /**
     * Get seenMovies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeenMovies()
    {
        return $this->seenMovies;
    }

    /**
     * Add seenEpisode
     *
     * @param \AppBundle\Entity\Episode $seenEpisode
     *
     * @return User
     */
    public function addSeenEpisode(\AppBundle\Entity\Episode $seenEpisode)
    {
        $this->seenEpisode[] = $seenEpisode;

        return $this;
    }

    /**
     * Remove seenEpisode
     *
     * @param \AppBundle\Entity\Episode $seenEpisode
     */
    public function removeSeenEpisode(\AppBundle\Entity\Episode $seenEpisode)
    {
        $this->seenEpisode->removeElement($seenEpisode);
    }

    /**
     * Get seenEpisode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeenEpisode()
    {
        return $this->seenEpisode;
    }

    /**
     * Add seenTvShow
     *
     * @param \AppBundle\Entity\TVShow $seenTvShow
     *
     * @return User
     */
    public function addSeenTvShow(\AppBundle\Entity\TVShow $seenTvShow)
    {
        $this->seenTvShow[] = $seenTvShow;

        return $this;
    }

    /**
     * Remove seenTvShow
     *
     * @param \AppBundle\Entity\TVShow $seenTvShow
     */
    public function removeSeenTvShow(\AppBundle\Entity\TVShow $seenTvShow)
    {
        $this->seenTvShow->removeElement($seenTvShow);
    }

    /**
     * Get seenTvShow
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeenTvShow()
    {
        return $this->seenTvShow;
    }

    /**
     * Add moviePlaylist
     *
     * @param \AppBundle\Entity\Movie $moviePlaylist
     *
     * @return User
     */
    public function addMoviePlaylist(\AppBundle\Entity\Movie $moviePlaylist)
    {
        $this->moviePlaylist[] = $moviePlaylist;

        return $this;
    }

    /**
     * Remove moviePlaylist
     *
     * @param \AppBundle\Entity\Movie $moviePlaylist
     */
    public function removeMoviePlaylist(\AppBundle\Entity\Movie $moviePlaylist)
    {
        $this->moviePlaylist->removeElement($moviePlaylist);
    }

    /**
     * Get moviePlaylist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoviePlaylist()
    {
        return $this->moviePlaylist;
    }

    /**
     * Add episodePlaylist
     *
     * @param \AppBundle\Entity\Episode $episodePlaylist
     *
     * @return User
     */
    public function addEpisodePlaylist(\AppBundle\Entity\Episode $episodePlaylist)
    {
        $this->episodePlaylist[] = $episodePlaylist;

        return $this;
    }

    /**
     * Remove episodePlaylist
     *
     * @param \AppBundle\Entity\Episode $episodePlaylist
     */
    public function removeEpisodePlaylist(\AppBundle\Entity\Episode $episodePlaylist)
    {
        $this->episodePlaylist->removeElement($episodePlaylist);
    }

    /**
     * Get episodePlaylist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodePlaylist()
    {
        return $this->episodePlaylist;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return User
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return boolean
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
    * Set roles
    *
    * @param array $roles
    *
    * @return User
    */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
