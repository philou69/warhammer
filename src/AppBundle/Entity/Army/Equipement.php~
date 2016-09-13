<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
* Equipement
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
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\EquipementFigurine", mappedBy="equipement")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $figurines;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->figurines = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Options
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

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Options
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
     * Add figurine
     *
     * @param \AppBundle\Entity\Army\EquipementFigurine $figurine
     *
     * @return Options
     */
    public function addFigurine(\AppBundle\Entity\Army\EquipementFigurine $figurine)
    {
        $this->figurines[] = $figurine;

        return $this;
    }

    /**
     * Remove figurine
     *
     * @param \AppBundle\Entity\Army\EquipementFigurine $figurine
     */
    public function removeFigurine(\AppBundle\Entity\Army\EquipementFigurine $figurine)
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



    public function getNameAndPoints()
    {
        return $this->name.' '.$this->points;
    }
}
