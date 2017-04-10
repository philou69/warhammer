<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitArmy.
 *
 * @ORM\Table(name="unit_army")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\UnitArmyRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UnitArmy
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Unit", inversedBy="armies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Army", inversedBy="units")
     * @ORM\JoinColumn(nullable=false)
     */
    private $army;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Army\Equipement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $equipements;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\PhotoUnit", mappedBy="unit", cascade={"all"})
     */
    private $photos;

    /**
     * @ORM\Column(name="points", type="integer", nullable = true)
     */
    private $points;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->unit->getName();
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
     * @return UnitArmy
     */
    public function setUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->unit = $unit;
        $this->points = $unit->getPoints();

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
     * Set army.
     *
     * @param \AppBundle\Entity\Army\Army $army
     *
     * @return UnitArmy
     */
    public function setArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->army = $army;
        $army->setPoints($this->points);

        return $this;
    }

    /**
     * Get army.
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
            $photo->setUnit($this);
        }
        $this->photos = $photos;

        return $this;
    }

    /**
     * Add photo.
     *
     * @param \AppBundle\Entity\Army\PhotoUnit $photo
     *
     * @return UnitArmy
     */
    public function addPhoto(\AppBundle\Entity\Army\PhotoUnit $photo)
    {
        $photo->setUnit($this);
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo.
     *
     * @param \AppBundle\Entity\Army\PhotoUnit $photo
     */
    public function removePhoto(\AppBundle\Entity\Army\PhotoUnit $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set points.
     *
     * @param int $points
     *
     * @return UnitArmy
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
        $this->points = $this->unit->getPoints();
        foreach ($this->equipements as $equipement)
        {
            $this->points += $equipement->getPoints();
        }
        return $this->points;
    }

    /**
     * Add equipement.
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     *
     * @return UnitArmy
     */
    public function addEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->points = $this->points + $equipement->getPoints();
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement.
     *
     * @param \AppBundle\Entity\Army\Equipement $equipement
     */
    public function removeEquipement(\AppBundle\Entity\Army\Equipement $equipement)
    {
        $this->points = $this->points - $equipement->getPoints();
        $this->equipements->removeElement($equipement);
    }

    /**
     * Get equipements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function countPoints()
    {

        // On créer une vartiable points valnt les points de la unit + les points d'équipements
        $points = $this->unit->getPoints();
        foreach ($this->equipements as $equipement) {
            $points = $points + $equipement->getPoints();
        }

        // On calcule les nouveaux points de l'armée en lui ajoutant la difference des points - les points de la unitarmée
        $armyPoints = $this->army->getPoints() + ($points - $this->points);
        $this->army->setPoints($armyPoints);

        $this->points = $points;
    }

    /**
     * @ORM\PreRemove
     */
    public function countArmy()
    {
        // On compte les points de l'armée sans ceux de la unit armé
        $armyPoints = $this->army->getPoints() - $this->points;

        $this->army->setPoints($armyPoints);
    }
}
