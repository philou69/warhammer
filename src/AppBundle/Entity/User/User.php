<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User.
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Army\Army", mappedBy="user", cascade={"all"})
     */
    protected $armies;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Add army.
     *
     * @param \AppBundle\Entity\Army\Army $army
     *
     * @return User
     */
    public function addArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->armies[] = $army;

        return $this;
    }

    /**
     * Remove army.
     *
     * @param \AppBundle\Entity\Army\Army $army
     */
    public function removeArmy(\AppBundle\Entity\Army\Army $army)
    {
        $this->armies->removeElement($army);
    }

    /**
     * Get armies.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArmies()
    {
        return $this->armies;
    }
}
