<?php


namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Figurine
 * @package AppBundle\Entity\Army
 *
 * @ORM\Table(name="figurine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\FigurineRepository")
 */
class Figurine
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="number", type="integer")
     */
    protected $number;
    /**
     * @ORM\Column(name="cc", type="integer",nullable=true)
     */
    protected $cc;

    /**
     * @ORM\Column(name="ct", type="integer")
     */
    protected $ct;

    /**
     * @ORM\Column(name="f", type="integer", nullable=true)
     */
    protected $f;

    /**
     * @ORM\Column(name="e", type="integer", nullable=true)
     */
    protected $e;

    /**
     * @ORM\Column(name="pv", type="integer")
     */
    protected $pv;

    /**
     * @ORM\Column(name="i", type="integer", nullable=true)
     */
    protected $i;

    /**
     * @ORM\Column(name="a", type="integer", nullable=true)
     */
    protected $a;

    /**
     * @ORM\Column(name="cd", type="integer", nullable=true)
     */
    protected $cd;

    /**
     * @ORM\Column(name="sv", type="string", nullable=true)
     */
    protected $sv;

    /**
     * @ORM\Column(name="blindage_av", type="integer", nullable=true)
     */
    protected $blindageAv;

    /**
     * @ORM\Column(name="blindage_fl", type="integer", nullable=true)
     */
    protected $blindageFl;

    /**
     * @ORM\Column(name="blindage_ar", type="integer", nullable=true)
     */
    protected $blindageAr;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\Type")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $type;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Army\Unit", inversedBy="figurines")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $units;

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
     * @return Figurine
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
     * Set number
     *
     * @param integer $number
     *
     * @return Figurine
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set cc
     *
     * @param integer $cc
     *
     * @return Figurine
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return integer
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set ct
     *
     * @param integer $ct
     *
     * @return Figurine
     */
    public function setCt($ct)
    {
        $this->ct = $ct;

        return $this;
    }

    /**
     * Get ct
     *
     * @return integer
     */
    public function getCt()
    {
        return $this->ct;
    }

    /**
     * Set f
     *
     * @param integer $f
     *
     * @return Figurine
     */
    public function setF($f)
    {
        $this->f = $f;

        return $this;
    }

    /**
     * Get f
     *
     * @return integer
     */
    public function getF()
    {
        return $this->f;
    }

    /**
     * Set e
     *
     * @param integer $e
     *
     * @return Figurine
     */
    public function setE($e)
    {
        $this->e = $e;

        return $this;
    }

    /**
     * Get e
     *
     * @return integer
     */
    public function getE()
    {
        return $this->e;
    }

    /**
     * Set pv
     *
     * @param integer $pv
     *
     * @return Figurine
     */
    public function setPv($pv)
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * Get pv
     *
     * @return integer
     */
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * Set i
     *
     * @param integer $i
     *
     * @return Figurine
     */
    public function setI($i)
    {
        $this->i = $i;

        return $this;
    }

    /**
     * Get i
     *
     * @return integer
     */
    public function getI()
    {
        return $this->i;
    }

    /**
     * Set a
     *
     * @param integer $a
     *
     * @return Figurine
     */
    public function setA($a)
    {
        $this->a = $a;

        return $this;
    }

    /**
     * Get a
     *
     * @return integer
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * Set cd
     *
     * @param integer $cd
     *
     * @return Figurine
     */
    public function setCd($cd)
    {
        $this->cd = $cd;

        return $this;
    }

    /**
     * Get cd
     *
     * @return integer
     */
    public function getCd()
    {
        return $this->cd;
    }

    /**
     * Set sv
     *
     * @param string $sv
     *
     * @return Figurine
     */
    public function setSv($sv)
    {
        $this->sv = $sv;

        return $this;
    }

    /**
     * Get sv
     *
     * @return string
     */
    public function getSv()
    {
        return $this->sv;
    }

    /**
     * Set blindageAv
     *
     * @param integer $blindageAv
     *
     * @return Figurine
     */
    public function setBlindageAv($blindageAv)
    {
        $this->blindageAv = $blindageAv;

        return $this;
    }

    /**
     * Get blindageAv
     *
     * @return integer
     */
    public function getBlindageAv()
    {
        return $this->blindageAv;
    }

    /**
     * Set blindageFl
     *
     * @param integer $blindageFl
     *
     * @return Figurine
     */
    public function setBlindageFl($blindageFl)
    {
        $this->blindageFl = $blindageFl;

        return $this;
    }

    /**
     * Get blindageFl
     *
     * @return integer
     */
    public function getBlindageFl()
    {
        return $this->blindageFl;
    }

    /**
     * Set blindageAr
     *
     * @param integer $blindageAr
     *
     * @return Figurine
     */
    public function setBlindageAr($blindageAr)
    {
        $this->blindageAr = $blindageAr;

        return $this;
    }

    /**
     * Get blindageAr
     *
     * @return integer
     */
    public function getBlindageAr()
    {
        return $this->blindageAr;
    }

    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     *
     * @return Figurine
     */
    public function setUnit(\AppBundle\Entity\Army\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Army\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Army\Type $type
     *
     * @return Figurine
     */
    public function setType(\AppBundle\Entity\Army\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Army\Type
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->units = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add unit
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     *
     * @return Figurine
     */
    public function addUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->units[] = $unit;

        return $this;
    }

    /**
     * Remove unit
     *
     * @param \AppBundle\Entity\Army\Unit $unit
     */
    public function removeUnit(\AppBundle\Entity\Army\Unit $unit)
    {
        $this->units->removeElement($unit);
    }

    /**
     * Get units
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnits()
    {
        return $this->units;
    }

    public function __toString()
    {
        return $this->name . ", " . $this->number . "nb, cc" . $this->cc . ', ct' . $this->ct . ', f ' . $this->f . ',e ' . $this->e . ', pv' . $this->pv . ', i' . $this->i . ',a ' . $this->a . ',cd ' . $this->cd . ',sv ' . $this->sv . 'blind av ' . $this->blindageAv . 'blindf' . $this->blindageFl . ', blind ar ' . $this->blindageAr;
    }
}
