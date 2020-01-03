<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AlbumBundle\Entity\Album", mappedBy="author")
     */
    protected $albums;


    public function __construct()
    {
        parent::__construct();
        $this->albums = new ArrayCollection();
    }



    /**
     * Add album.
     *
     * @param \AlbumBundle\Entity\Album $album
     *
     * @return User
     */
    public function addAlbum(\AlbumBundle\Entity\Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album.
     *
     * @param \AlbumBundle\Entity\Album $album
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAlbum(\AlbumBundle\Entity\Album $album)
    {
        return $this->albums->removeElement($album);
    }

    /**
     * Get albums.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbums()
    {
        return $this->albums;
    }
}
