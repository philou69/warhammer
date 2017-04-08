<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race.
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\RaceRepository")
 */
class Race
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", unique=true)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\Army", mappedBy="race")
     */
    private $armies;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\Unit", mappedBy="race")
     */
    private $units;

    public function __toString()
    {
        return $this->name;
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
     * @return Race
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
     * Get armies
     *
     * @return mixed
     */
    public function getArmies()
    {
        return $this->armies;
    }

    /**
     * Set armies
     *
     * @param mixed $armies
     *
     * @return $this
     */
    public function setArmies($armies)
    {
        $this->armies = $armies;

        return $this;
    }

    /**
     * Get units
     *
     * @return mixed
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set units
     *
     * @param mixed $units
     *
     * @return $this
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->armies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->units = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add army
     *
     * @param \AppBundle\Entity\Army\Army $army
     *
     * @return Race
     */
    public function addArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->armies[] = $army;

        return $this;
    }

    /**
     * Remove army
     *
     * @param \AppBundle\Entity\Army\Army $army
     */
    public function removeArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->armies->removeElement($army);
    }

    /**
     * Add unit
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     *
     * @return Race
     */
    public function addUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     */
    public function removeUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->units->removeElement($unit);
    }
}
