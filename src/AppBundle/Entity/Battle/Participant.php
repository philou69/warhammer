<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Participant.
 *
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\ParticipantRepository")
 * @AppAssert\Participant
 * @ORM\HasLifecycleCallbacks()
 */
class Participant
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Battle\Battle", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $battle;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Battle\Presence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $presence;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Army")
     * @ORM\JoinColumn( nullable=true)
     */
    private $army;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->participant->getUsername();
    }

    /**
     * Set battle.
     *
     * @param \AppBundle\Entity\Battle\Battle $battle
     *
     * @return Participant
     */
    public function setBattle(\AppBundle\Entity\Battle\Battle $battle)
    {
        $this->battle = $battle;

        return $this;
    }

    /**
     * Get battle.
     *
     * @return \AppBundle\Entity\Battle\Battle
     */
    public function getBattle()
    {
        return $this->battle;
    }

    /**
     * Set participant.
     *
     * @param \AppBundle\Entity\User\User $participant
     *
     * @return Participant
     */
    public function setParticipant(\AppBundle\Entity\User\User $participant)
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * Get participant.
     *
     * @return \AppBundle\Entity\User\User
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set presence.
     *
     * @param \AppBundle\Entity\Battle\Presence $presence
     *
     * @return Participant
     */
    public function setPresence(\AppBundle\Entity\Battle\Presence $presence = null)
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get presence.
     *
     * @return \AppBundle\Entity\Battle\Presence
     */
    public function getPresence()
    {
        return $this->presence;
    }

    /**
     * Set army.
     *
     * @param \AppBundle\Entity\Army\Army $army
     *
     * @return Participant
     */
    public function setArmy(\AppBundle\Entity\Army\Army $army = null)
    {
        $this->army = $army;

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


    public function haveCombat(){
        if($this->presence->getPresence() === "participera au combat"){
            return $this->presence->getUsername() . ' a commandé l\'armée' . $this->army->getName();
        }
    }

    public function getStatus()
    {
        if($this->presence->getPresence() === "serez présent"){
            return 'assistera au massacre';
        }elseif ($this->presence->getPresence() === "ne serez pas présent"){
            return "ne sera pas là";
        }elseif ($this->presence->getPresence() === " participera au combat"){
            return "Commandera l'armée " . $this->army->getName();
        }else{
            return "n'a pas répondu";
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function verifyArmy(){
        if($this->presence->getPresence() !== "participerez au combat" && $this->army !== null){
            $this->army = null;
        }
    }
}
