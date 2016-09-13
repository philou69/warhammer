<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Army
 *
 * @ORM\Table(name="army")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\ArmyRepository")
 * @UniqueEntity("name")
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
	 */
	private $name;

	/**
	 * @ORM\Column(name="points", type="integer", nullable=true)
	 */
	private $points;

	/**
	 * @Gedmo\Slug(fields={"name"})
	 * @ORM\Column(name="slug_army", length=128, unique=true)
	 */
	private $slugArmy;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Race")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $race;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="armies")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $user;

	/**
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\FigurineArmy", mappedBy="army", cascade={"remove"})
	 * @ORM\JoinColumn(nullable=true)
	 */
	private $figurines;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->figurines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->points = 0;
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
     * @return Army
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
     * @return Army
     */
    public function setPoints($points)
    {
        $this->points = $this->points + $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        $points = 0;
        foreach ($this->figurines as $figurine) {
            $points += $figurine->getPoints();
        }
        return $points;
    }

    /**
     * Set slugArmy
     *
     * @param string $slugArmy
     *
     * @return Army
     */
    public function setSlugArmy($slugArmy)
    {
        $this->slugArmy = $slugArmy;

        return $this;
    }

    /**
     * Get slugArmy
     *
     * @return string
     */
    public function getSlugArmy()
    {
        return $this->slugArmy;
    }

    /**
     * Set race
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
     * Get race
     *
     * @return \AppBundle\Entity\Army\Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set user
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
     * Get user
     *
     * @return \AppBundle\Entity\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add figurine
     *
     * @param \AppBundle\Entity\Army\FigurineArmy $figurine
     *
     * @return Army
     */
    public function addFigurine(\AppBundle\Entity\Army\FigurineArmy $figurine)
    {
        $this->figurines[] = $figurine;
        $this->points += $figurine->getPoints();

        return $this;
    }

    /**
     * Remove figurine
     *
     * @param \AppBundle\Entity\Army\FigurineArmy $figurine
     */
    public function removeFigurine( \AppBundle\Entity\Army\FigurineArmy $figurine)
    {
        $this->points -= $figurine->getPoints();
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
}
