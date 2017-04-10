<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Army.
 *
 * @ORM\Table(name="army")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\ArmyRepository")
 * @UniqueEntity(fields="name", message="Une armée porte déjà ce nom")
 */
class Army
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Race", inversedBy="armies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="armies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\UnitArmy", mappedBy="army", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $units;

    private $groupes = ['QG', 'Elite', 'Troupe', 'Transport', 'Attaque Rapide', 'Soutien', 'Seigneur de Guerre'];
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->units = new \Doctrine\Common\Collections\ArrayCollection();
        $this->points = 0;
    }

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
     * @return Army
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
     * @return Army
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
        $points = 0;
        foreach ($this->units as $unit) {
            $points += $unit->getPoints();
        }
        $this->points = $points;
        return $points;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Army
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set race.
     *
     * @param \AppBundle\Entity\Army\Race $race
     *
     * @return Army
     */
    public function setRace(\AppBundle\Entity\Army\Race $race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race.
     *
     * @return \AppBundle\Entity\Army\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User\User $user
     *
     * @return Army
     */
    public function setUser(\AppBundle\Entity\User\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add unit.
     *
     * @param \AppBundle\Entity\Army\UnitArmy $unit
     *
     * @return Army
     */
    public function addUnit(\AppBundle\Entity\Army\UnitArmy $unit)
    {
        $this->units[] = $unit;
        $this->points += $unit->getPoints();
        $unit->setArmy($this);
        return $this;
    }

    /**
     * Remove unit.
     *
     * @param \AppBundle\Entity\Army\UnitArmy $unit
     */
    public function removeUnit(\AppBundle\Entity\Army\UnitArmy $unit)
    {
        $this->points -= $unit->getPoints();
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

    public function getGroupes()
    {
        return $this->groupes;
    }

}
