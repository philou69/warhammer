<?php


namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Features
 * @package AppBundle\Form\Army
 *
 * @ORM\Table(name="feature")
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\Army\FeatureRepository"
 * )
 */
class Features
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Army\Figurine", inversedBy="feature")
     */
    protected $figurine;

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
     * Set number
     *
     * @param integer $number
     *
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * @return Features
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
     * Set figurine
     *
     * @param \AppBundle\Entity\Army\Figurine $figurine
     *
     * @return Features
     */
    public function setFigurine(\AppBundle\Entity\Army\Figurine $figurine = null)
    {
        $this->figurine = $figurine;

        return $this;
    }

    /**
     * Get figurine
     *
     * @return \AppBundle\Entity\Army\Figurine
     */
    public function getFigurine()
    {
        return $this->figurine;
    }
}
