<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Figurine.
 *
 * @ORM\Table(name="figurine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\FigurineRepository")
 */
class Figurine
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Race", inversedBy="figurines")
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Groupe")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\FigurineArmy", mappedBy="figurine")
     */
    private $armies;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\EquipementFigurine", mappedBy="figurine")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipements;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Army\Features", mappedBy="figurine")
     */
    private $feature;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->armies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name." ".$this->points;
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
     * Set name.
     *
     * @param string $name
     *
     * @return Figurine
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set points.
     *
     * @param int $points
     *
     * @return Figurine
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set race.
     *
     * @param \AppBundle\Entity\Army\Race $race
     *
     * @return Figurine
     */
    public function setRace(\AppBundle\Entity\Army\Race $race = null)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race.
     *
     * @return \AppBundle\Entity\Army\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set groupe.
     *
     * @param \AppBundle\Entity\Army\Groupe $groupe
     *
     * @return Figurine
     */
    public function setGroupe(\AppBundle\Entity\Army\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe.
     *
     * @return \AppBundle\Entity\Army\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Add army.
     *
     * @param \AppBundle\Entity\Army\FigurineArmy $army
     *
     * @return Figurine
     */
    public function addArmy(\AppBundle\Entity\Army\FigurineArmy $army)
    {
        $this->armies[] = $army;

        return $this;
    }

    /**
     * Remove army.
     *
     * @param \AppBundle\Entity\Army\FigurineArmy $army
     */
    public function removeArmy(\AppBundle\Entity\Army\FigurineArmy $army)
    {
        $this->armies->removeElement($army);
    }

    /**
     * Get armies.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArmies()
    {
        return $this->armies;
    }

    /**
     * Add equipement.
     *
     * @param \AppBundle\Entity\Army\EquipementFigurine $equipement
     *
     * @return Figurine
     */
    public function addEquipement(\AppBundle\Entity\Army\EquipementFigurine $equipement)
    {
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement.
     *
     * @param \AppBundle\Entity\Army\EquipementFigurine $equipement
     */
    public function removeEquipement(\AppBundle\Entity\Army\EquipementFigurine $equipement)
    {
        $this->equipements->removeElement($equipement);
    }

    /**
     * Get equipements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points.' pts';
    }

    /**
     * Set feature
     *
     * @param \AppBundle\Entity\Army\Features $feature
     *
     * @return Figurine
     */
    public function setFeature(\AppBundle\Entity\Army\Features $feature = null)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return \AppBundle\Entity\Army\Features
     */
    public function getFeature()
    {
        return $this->feature;
    }
}
