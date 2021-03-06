<?php

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resume.
 *
 * @ORM\Table(name="resume")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\ResumeRepository")
 */
class Resume
{
    /**
   * @ORM\Column(type="guid")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="UUID")
   */
  private $id;

  /**
   * @ORM\Column(name="resume", type="text")
   */
  private $resume;

  /**
   * @ORM\OneToOne(targetEntity="AppBundle\Entity\Battle\Battle", inversedBy="resume")
   * @ORM\JoinColumn(nullable= false)
   */
  private $battle;

  public function __toString()
  {
      return $this->resume;
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
     * Set resume.
     *
     * @param string $resume
     *
     * @return Resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume.
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set battle.
     *
     * @param \AppBundle\Entity\Battle\Battle $battle
     *
     * @return Resume
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
}
