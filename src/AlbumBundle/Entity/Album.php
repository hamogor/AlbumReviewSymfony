<?php

namespace AlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="AlbumBundle\Repository\AlbumRepository")
 */
class Album
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
     * @ORM\Column(name="artist", type="string", length=255)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(name="isrc", type="string", length=12, unique=false)
     */
    private $isrc;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", unique=false)
     */
    private $image;

    /**
     * @var array
     *
     * @ORM\Column(name="trackList", type="array")
     */
    private $trackList;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="albums")
     * @ORM\JoinColumn(name="author", referencedColumnName="id", unique=false)
     */
    private $author;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Album
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set artist.
     *
     * @param string $artist
     *
     * @return Album
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist.
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set isrc.
     *
     * @param string $isrc
     *
     * @return Album
     */
    public function setIsrc($isrc)
    {
        $this->isrc = $isrc;

        return $this;
    }

    /**
     * Get isrc.
     *
     * @return string
     */
    public function getIsrc()
    {
        return $this->isrc;
    }

    /**
     * Set trackList.
     *
     * @param array $trackList
     *
     * @return Album
     */
    public function setTrackList($trackList)
    {
        $this->trackList = $trackList;

        return $this;
    }

    /**
     * Get trackList.
     *
     * @return array
     */
    public function getTrackList()
    {
        return $this->trackList;
    }

    /**
     * Set author.
     *
     * @param string $author
     *
     * @return Album
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Album
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
