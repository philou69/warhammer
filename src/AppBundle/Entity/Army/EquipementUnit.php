<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipementUnit.
 *
 * @ORM\Table(name="equipement_unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\EquipementUnitRepository")
 */
class EquipementUnit
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Unit", inversedBy="equipements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Equipement", inversedBy="units")
     */
    private $equipement;

    public function __toString()
    {
        return $this->unit->getName().' -> '.$this->equipement->getName();
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
     * Set unit.
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     *
     * @return EquipementUnit
     */
    public function setUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit.
     *
     * @return \AppBundle\Entity\Army\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set equipement.
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return EquipementUnit
     */
    public function setEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->equipement = $equipement;

        return $this;
    }

    /**
     * Get equipement.
     *
     * @return \AppBundle\Entity\Army\Equipement
     */
    public function getEquipement()
    {
        return $this->equipement;
    }
}
