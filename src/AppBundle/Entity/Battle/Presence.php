<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presence.
 *
 * @ORM\Table(name="presence")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\PresenceRepository")
 */
class Presence
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="presence", type="string", length=255)
     */
    private $presence;

    public function __toString()
    {
        return $this->presence;
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
     * Set presence.
     *
     * @param string $presence
     *
     * @return Presence
     */
    public function setPresence($presence)
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get presence.
     *
     * @return string
     */
    public function getPresence()
    {
        return $this->presence;
    }
}
