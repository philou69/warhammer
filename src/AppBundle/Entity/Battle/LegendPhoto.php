<?php 

namespace AppBundle\Entity\Battle;

use Doctrine\ORM\Mapping as ORM;

/**
* LegendPhoto
*
* @ORM\Table(name="legend_photo")
* @ORM\Entity(repositoryClass="AppBundle\Repository\Battle\LegendPhotoRepository")
*/
class LegendPhoto
{
	
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(name="legend", type="string", length=255)
	 */
	private $legend;
        

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
     * Set legend
     *
     * @param string $legend
     *
     * @return LegendPhoto
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }
}
