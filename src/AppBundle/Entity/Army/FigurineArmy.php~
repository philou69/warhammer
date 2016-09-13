<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
* FigurineArmy
*
* @ORM\Table(name="figurine_army")
* @ORM\Entity(repositoryClass="AppBundle\Repository\Army\FigurineArmyRepository")
* @ORM\HasLifecycleCallbacks()
*/

class FigurineArmy
{
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Figurine", inversedBy="armies")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $figurine;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Army", inversedBy="figurines")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $army;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Army\Equipement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $equipements;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\PhotoFigurine", mappedBy="figurine", cascade={"all"})
     */
    private $photos;

    /**
     * @ORM\Column(name="points", type="integer", nullable = true)
     */
    private $points;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set figurine
     *
     * @param \AppBundle\Entity\Army\Figurine $figurine
     *
     * @return FigurineArmy
     */
    public function setFigurine(\AppBundle\Entity\Army\Figurine $figurine)
    {
        $this->figurine = $figurine;
        $this->points = $figurine->getPoints();

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
     * Set army
     *
     * @param \AppBundle\Entity\Army\Army $army
     *
     * @return FigurineArmy
     */
    public function setArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->army = $army;
        $army->setPoints($this->points);
        return $this;
    }

    /**
     * Get army
     *
     * @return \AppBundle\Entity\Army\Army
     */
    public function getArmy()
    {
        return $this->army;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos)
    {
        foreach ($photos as $photo) {
            $photo->setFigurine($this);
        }
        $this->photos = $photos;
        return $this;
    }



    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Army\PhotoFigurine $photo
     *
     * @return FigurineArmy
     */
    public function addPhoto(\AppBundle\Entity\Army\PhotoFigurine $photo)
    {

        $photo->getFigurine($this);
        $this->photos[] = $photo;
        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Army\PhotoFigurine $photo
     */
    public function removePhoto(\AppBundle\Entity\Army\PhotoFigurine $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
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
		/*	$this->points = $this->figurine->getPoints();
			foreach ($this->equipements as $equipement)
			{
				$this->points += $equipement->getPoints();
			}*/
        return $this->points;
    }




    /**
     * Add equipement
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return FigurineArmy
     */
    public function addEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->points = $this->points + $equipement->getPoints();
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     */
    public function removeEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->points = $this->points - $equipement->getPoints();
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


}
