<?php

namespace AppBundle\Entity\Unit;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unit.
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Unit\UnitRepository")
 */
class Unit
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Race", inversedBy="units")
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Groupe")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Unit\Figurine", mappedBy="unit", cascade={"persist", "remove"})
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
     * Set race.
     *
     * @param \AppBundle\Entity\Unit\Race $race
     *
     * @return Unit
     */
    public function setRace(\AppBundle\Entity\Unit\Race $race = null)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race.
     *
     * @return \AppBundle\Entity\Unit\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set groupe.
     *
     * @param \AppBundle\Entity\Unit\Groupe $groupe
     *
     * @return Unit
     */
    public function setGroupe(\AppBundle\Entity\Unit\Groupe $groupe = null)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe.
     *
     * @return \AppBundle\Entity\Unit\Groupe
     */
    public function getGroupe()
    {
        return $this->groupe;
    }



    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points.' pts';
    }

    /**
     * Add figurine
     *
     * @param \AppBundle\Entity\Unit\Figurine $figurine
     *
     * @return Unit
     */
    public function addFigurine(\AppBundle\Entity\Unit\Figurine $figurine)
    {
        $this->figurines[] = $figurine;
        $figurine->setUnit($this);
        return $this;
    }

    /**
     * Remove figurine
     *
     * @param \AppBundle\Entity\Unit\Figurine $figurine
     */
    public function removeFigurine(\AppBundle\Entity\Unit\Figurine $figurine)
    {
        $this->figurines->removeElement($figurine);
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
}
