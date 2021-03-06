<?php

namespace AppBundle\Entity\Unit;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement.
 *
 * @ORM\Table(name="equipement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Unit\EquipementRepository")
 */
class Equipement
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
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Figurine", inversedBy="equipements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figurine;

    public function __toString()
    {
        return $this->name.' '.$this->points .' pts';
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
     * @return Equipement
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
     * @return Equipement
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

    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points;
    }


    /**
     * Set figurine
     *
     * @param \AppBundle\Entity\Unit\Figurine $figurine
     *
     * @return Equipement
     */
    public function setFigurine(\AppBundle\Entity\Unit\Figurine $figurine)
    {
        $this->figurine = $figurine;

        return $this;
    }

    /**
     * Get figurine
     *
     * @return \AppBundle\Entity\Unit\Figurine
     */
    public function getFigurine()
    {
        return $this->figurine;
    }
}
