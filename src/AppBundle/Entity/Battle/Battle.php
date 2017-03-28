<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Battle.
 *
 * @ORM\Table(name="battle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\BattleRepository")
 * @UniqueEntity(fields="name", message="une bataille porte déjà ce nom")
 * @AppAssert\Battle
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false )
     * @Assert\NotBlank()
     */
    private $lieu;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", length=128, unique=true)
     */
    private $slug;

     /**
      * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
      * @ORM\JoinColumn(nullable=false)
      */
     private $createur;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Battle\Participant", mappedBy="battle", cascade={"persist","refresh","remove"})
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
     * Set slug.
     *
     * @param string $slug
     *
     * @return Battle
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
