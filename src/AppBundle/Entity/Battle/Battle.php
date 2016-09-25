<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Battle.
 *
 * @ORM\Table(name="battle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\BattleRepository")
 * @UniqueEntity(fields="name", message="une bataille porte déjà ce nom")
 */
class Battle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug_battle", length=128, unique=true)
     */
    private $slugBattle;

     /**
      * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
      * @ORM\JoinColumn(nullable=false)
      */
     private $createur;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Battle\Participant", mappedBy="battle", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $participants;

    /**
     * @ORM\Column(name="canceled", type="boolean")
     */
    private $canceled;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Battle\Resume", mappedBy="battle", cascade={"remove"})
     */
    private $resume;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->canceled = false;
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
     * @return Battle
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Battle
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lieu.
     *
     * @param string $lieu
     *
     * @return Battle
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu.
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set slugBattle.
     *
     * @param string $slugBattle
     *
     * @return Battle
     */
    public function setSlugBattle($slugBattle)
    {
        $this->slugBattle = $slugBattle;

        return $this;
    }

    /**
     * Get slugBattle.
     *
     * @return string
     */
    public function getSlugBattle()
    {
        return $this->slugBattle;
    }

    

    /**
     * Set createur.
     *
     * @param \AppBundle\Entity\User\User $createur
     *
     * @return Battle
     */
    public function setCreateur(\AppBundle\Entity\User\User $createur)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur.
     *
     * @return \AppBundle\Entity\User\User
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Add participant.
     *
     * @param \AppBundle\Entity\Battle\Participant $participant
     *
     * @return Battle
     */
    public function addParticipant(\AppBundle\Entity\Battle\Participant $participant)
    {
        $participant->setBattle($this);
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant.
     *
     * @param \AppBundle\Entity\Battle\Participant $participant
     */
    public function removeParticipant(\AppBundle\Entity\Battle\Participant $participant)
    {
        $this->participants->removeElement($participant);
    }

    public function setParticipants()
    {
        foreach ($this->participants as $participant) {
            $this->add($participant);
        }

        return $this;
    }
    /**
     * Get participants.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set canceld.
     *
     * @param bool $canceled
     *
     * @return Battle
     */
    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;

        return $this;
    }

    /**
     * Get canceled.
     *
     * @return bool
     */
    public function getCanceled()
    {
        return $this->canceled;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }
}
