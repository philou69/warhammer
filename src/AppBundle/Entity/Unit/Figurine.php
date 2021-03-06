<?php


namespace AppBundle\Entity\Unit;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Figurine
 * @package AppBundle\Entity\Army
 *
 * @ORM\Table(name="figurine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Unit\FigurineRepository")
 */
class Figurine
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $minQuantity;
    /**
     * @ORM\Column(type="integer")
     */
    protected $maxQuantity;

    /**
     * @ORM\Column(type="integer")
     */
    protected $move;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $weaponSkill;

    /**
     * @ORM\Column(type="integer")
     */
    protected $balisticSkill;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $strength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $toughness;

    /**
     * @ORM\Column(type="integer")
     */
    protected $wounds;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $attacks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $leaderShip;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $save;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Type")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit\Unit", inversedBy="figurines")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $unit;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Unit\Equipement", mappedBy="figurine", cascade={"persist", "remove"})
     */
    protected $equipements;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }


    /**
     * Set minQuantity
     *
     * @param integer $minQuantity
     *
     * @return Figurine
     */
    public function setMinQuantity($minQuantity)
    {
        $this->minQuantity = $minQuantity;

        return $this;
    }

    /**
     * Get minQuantity
     *
     * @return integer
     */
    public function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * Set maxQuantity
     *
     * @param integer $maxQuantity
     *
     * @return Figurine
     */
    public function setMaxQuantity($maxQuantity)
    {
        $this->maxQuantity = $maxQuantity;

        return $this;
    }

    /**
     * Get maxQuantity
     *
     * @return integer
     */
    public function getMaxQuantity()
    {
        return $this->maxQuantity;
    }

    /**
     * Set move
     *
     * @param integer $move
     *
     * @return Figurine
     */
    public function setMove($move)
    {
        $this->move = $move;

        return $this;
    }

    /**
     * Get move
     *
     * @return integer
     */
    public function getMove()
    {
        return $this->move;
    }

    /**
     * Set weaponSkill
     *
     * @param integer $weaponSkill
     *
     * @return Figurine
     */
    public function setWeaponSkill($weaponSkill)
    {
        $this->weaponSkill = $weaponSkill;

        return $this;
    }

    /**
     * Get weaponSkill
     *
     * @return integer
     */
    public function getWeaponSkill()
    {
        return $this->weaponSkill;
    }

    /**
     * Set balisticSkill
     *
     * @param integer $balisticSkill
     *
     * @return Figurine
     */
    public function setBalisticSkill($balisticSkill)
    {
        $this->balisticSkill = $balisticSkill;

        return $this;
    }

    /**
     * Get balisticSkill
     *
     * @return integer
     */
    public function getBalisticSkill()
    {
        return $this->balisticSkill;
    }

    /**
     * Set strength
     *
     * @param integer $strength
     *
     * @return Figurine
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set toughness
     *
     * @param integer $toughness
     *
     * @return Figurine
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }

    /**
     * Get toughness
     *
     * @return integer
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * Set wounds
     *
     * @param integer $wounds
     *
     * @return Figurine
     */
    public function setWounds($wounds)
    {
        $this->wounds = $wounds;

        return $this;
    }

    /**
     * Get wounds
     *
     * @return integer
     */
    public function getWounds()
    {
        return $this->wounds;
    }

    /**
     * Set attacks
     *
     * @param integer $attacks
     *
     * @return Figurine
     */
    public function setAttacks($attacks)
    {
        $this->attacks = $attacks;

        return $this;
    }

    /**
     * Get attacks
     *
     * @return integer
     */
    public function getAttacks()
    {
        return $this->attacks;
    }

    /**
     * Set leaderShip
     *
     * @param integer $leaderShip
     *
     * @return Figurine
     */
    public function setLeaderShip($leaderShip)
    {
        $this->leaderShip = $leaderShip;

        return $this;
    }

    /**
     * Get leaderShip
     *
     * @return integer
     */
    public function getLeaderShip()
    {
        return $this->leaderShip;
    }

    /**
     * Set save
     *
     * @param integer $save
     *
     * @return Figurine
     */
    public function setSave($save)
    {
        $this->save = $save;

        return $this;
    }

    /**
     * Get save
     *
     * @return integer
     */
    public function getSave()
    {
        return $this->save;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Unit\Type $type
     *
     * @return Figurine
     */
    public function setType(\AppBundle\Entity\Unit\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Unit\Type
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Unit\Unit $unit
     *
     * @return Figurine
     */
    public function setUnit(\AppBundle\Entity\Unit\Unit $unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Unit\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Add equipement
     *
     * @param \AppBundle\Entity\Unit\Equipement $equipement
     *
     * @return Figurine
     */
    public function addEquipement(\AppBundle\Entity\Unit\Equipement $equipement)
    {
        $this->equipements[] = $equipement;
        $equipement->setFigurine($this);
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
     * Set points
     *
     * @param integer $points
     *
     * @return Figurine
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
        return $this->points;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
