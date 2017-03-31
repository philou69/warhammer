<?php

namespace AppBundle\Entity\Army;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PhotoFigurine.
 *
 * @ORM\Table(name="photo_figurine")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Army\PhotoFigurineRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PhotoFigurine
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string")
     */
    private $alt;

  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Army\FigurineArmy", inversedBy="photos")
   * @ORM\JoinColumn(nullable=false)
   */
  private $figurine;

    /**
     * @Assert\File(maxSize="2M")
     */
    private $file;


    public function __toString()
    {
        return $this->url;
    }

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
  private $tempFilename;

    public function getFile()
    {
        return $this->file;
    }
  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
  public function setFile(UploadedFile $file)
  {
      $this->file = $file;

    // On vérifie si on avait déjà un fichier pour cette entité
    if (null !== $this->url) {
        // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->url;

      // On réinitialise les valeurs des attributs url et alt
      $this->url = null;
        $this->alt = null;
    }
    return $this;
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
      // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
        return;
    }

    // Le nom du fichier est son id, on doit juste stocker également son extension
    // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
    $this->url = uniqid().'.'.$this->file->guessExtension();

    // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
      // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
        return;
    }

    // Si on avait un ancien fichier, on le supprime
    if (null !== $this->tempFilename) {
        $oldFile = $this->getUploadRootDir().'/'.$this->tempFilename;
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
    }

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->url   // Le nom du fichier à créer, ici « id.extension »
    );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
      // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
      // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
        // On supprime le fichier
      unlink($this->tempFilename);
    }
      $this->figurine->removePhoto($this);
  }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
    return 'uploads/images';
    }

    public function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getUrl();
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
     * Set url.
     *
     * @param string $url
     *
     * @return PhotoFigurine
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt.
     *
     * @param string $alt
     *
     * @return PhotoFigurine
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt.
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set figurine.
     *
     * @param \AppBundle\Entity\Army\FigurineArmy $figurine
     *
     * @return PhotoFigurine
     */
    public function setFigurine(\AppBundle\Entity\Army\FigurineArmy $figurine)
    {
        $this->figurine = $figurine;

        return $this;
    }

    /**
     * Get figurine.
     *
     * @return \AppBundle\Entity\Army\FigurineArmy
     */
    public function getFigurine()
    {
        return $this->figurine;
    }
}
