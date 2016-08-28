<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
* EquipementFigurine
*
* @ORM\Table(name="equipement_figurine")
* @ORM\Entity(repositoryClass="AppBundle\Repository\Army\EquipementFigurineRepository")
*/

class EquipementFigurine
{
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Figurine", inversedBy="equipements")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $figurine;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Equipement", inversedBy="figurines")
	 */
	private $equipement;



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
     * Set figurine
     *
     * @param \AppBundle\Entity\Army\Figurine $figurine
     *
     * @return EquipementFigurine
     */
    public function setFigurine(\AppBundle\Entity\Army\Figurine $figurine)
    {
        $this->figurine = $figurine;

        return $this;
    }

    /**
     * Get figurine
     *
     * @return \AppBundle\Entity\Army\Figurine
     */
    public function getFigurine()
    {
        return $this->figurine;
    }

    /**
     * Set equipement
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return EquipementFigurine
     */
    public function setEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->equipement = $equipement;

        return $this;
    }

    /**
     * Get equipement
     *
     * @return \AppBundle\Entity\Army\Equipement
     */
    public function getEquipement()
    {
        return $this->equipement;
    }
}
