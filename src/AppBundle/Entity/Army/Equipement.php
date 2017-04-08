<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement.
 *
 * @ORM\Table(name="equipement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\EquipementRepository")
 */
class Equipement
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\EquipementUnit", mappedBy="equipement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $units;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->units = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name.' '.$this->points;
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
     * @return Options
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
     * @return Options
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
     * Add unit.
     *
     * @param \AppBundle\Entity\Army\EquipementUnit $unit
     *
     * @return Options
     */
    public function addUnit(\AppBundle\Entity\Army\EquipementUnit $unit)
    {
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit.
     *
     * @param \AppBundle\Entity\Army\EquipementUnit $unit
     */
    public function removeUnit(\AppBundle\Entity\Army\EquipementUnit $unit)
    {
        $this->units->removeElement($unit);
    }

    /**
     * Get units.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnits()
    {
        return $this->units;
    }

    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points;
    }
}
