<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unit.
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\UnitRepository")
 */
class Unit
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Race", inversedBy="units")
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Groupe")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\UnitArmy", mappedBy="unit")
     */
    private $armies;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Army\Equipement", inversedBy="units")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipements;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Army\Figurine", mappedBy="units")
     */
    private $figurines;

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
        return $this->name." ".$this->race->getName()." ".$this->points;
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
     * @return Unit
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
     * @return Unit
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
     * @return Unit
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
     * @return Unit
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
     * @param \AppBundle\Entity\Army\UnitArmy $army
     *
     * @return Unit
     */
    public function addArmy(\AppBundle\Entity\Army\UnitArmy $army)
    {
        $this->armies[] = $army;
        $army->setUnit($this);
        return $this;
    }

    /**
     * Remove army.
     *
     * @param \AppBundle\Entity\Army\UnitArmy $army
     */
    public function removeArmy(\AppBundle\Entity\Army\UnitArmy $army)
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

    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points.' pts';
    }

    /**
     * Add figurine
     *
     * @param \AppBundle\Entity\Army\Figurine $figurine
     *
     * @return Unit
     */
    public function addFigurine(\AppBundle\Entity\Army\Figurine $figurine)
    {
        $this->figurines[] = $figurine;
        $figurine->addUnit($this);
        return $this;
    }

    /**
     * Remove figurine
     *
     * @param \AppBundle\Entity\Army\Figurine $figurine
     */
    public function removeFigurine(\AppBundle\Entity\Army\Figurine $figurine)
    {
        $this->figurines->removeElement($figurine);
        $figurine->addUnit($this);
    }

    /**
     * Get figurines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFigurines()
    {
        return $this->figurines;
    }

    /**
     * Add equipement
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return Unit
     */
    public function addEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return Unit
     */
    public function removeEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->equipements->removeElement($equipement);
        return $this;
    }

    /**
     * Get equipements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }


}
