<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * PhotoBattle.
 *
 * @ORM\Table(name="photo_battle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\PhotoBattleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PhotoBattle
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Battle\Battle", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $battle;


    private $file;

    private $tempFilename;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->url) {
            $this->tempFilename = $this->url;

            $this->url = null;
            $this->alt = null;
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->url = uniqid().'.'.$this->file->guessExtension();
        $this->alt = $this->file->getClientOriginalName();
        $this->extension = $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir().'/'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $this->file->move(
            $this->getUploadRootDir(),
            $this->url);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        return 'uploads/img';
    }

    public function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getUrl();
    }

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
     * Set url.
     *
     * @param string $url
     *
     * @return PhotoBattle
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt.
     *
     * @param string $alt
     *
     * @return PhotoBattle
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt.
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set battle.
     *
     * @param \AppBundle\Entity\Battle\Battle $battle
     *
     * @return PhotoBattle
     */
    public function setBattle(\AppBundle\Entity\Battle\Battle $battle)
    {
        $this->battle = $battle;

        return $this;
    }

    /**
     * Get battle.
     *
     * @return \AppBundle\Entity\Battle\Battle
     */
    public function getBattle()
    {
        return $this->battle;
    }

}
