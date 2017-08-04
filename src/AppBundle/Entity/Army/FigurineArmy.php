<?php


namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FIgurineArmy
 * @package AppBundle\Entity\Army
 *
 * @ORM\Table(name="figurine_army")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\FigurineArmyRepository")
 */

class FigurineArmy
{
    /**
     * @ORM\Column(type="guid", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Figurine")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $figurine;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Unit\Equipement", cascade={"persist"})
     */
    protected $equipements;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\UnitArmy", inversedBy="figurines")
     */
    protected $unit;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $quantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $points;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return FigurineArmy
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        $this->points = $this->figurine->getPoints() * $this->quantity;
        foreach ($this->getEquipements() as $equipement)
        {
            $this->points += ($equipement->getPoints() * $this->quantity);
        }
        return $this->points;
    }

    /**
     * Set figurine
     *
     * @param \AppBundle\Entity\Unit\Figurine $figurine
     *
     * @return FigurineArmy
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

    /**
     * Add equipement
     *
     * @param \AppBundle\Entity\Unit\Equipement $equipement
     *
     * @return FigurineArmy
     */
    public function addEquipement(\AppBundle\Entity\Unit\Equipement $equipement)
    {
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \AppBundle\Entity\Unit\Equipement $equipement
     */
    public function removeEquipement(\AppBundle\Entity\Unit\Equipement $equipement)
    {
        $this->equipements->removeElement($equipement);
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

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return FigurineArmy
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Army\UnitArmy $unit
     *
     * @return FigurineArmy
     */
    public function setUnit(\AppBundle\Entity\Army\UnitArmy $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Army\UnitArmy
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
