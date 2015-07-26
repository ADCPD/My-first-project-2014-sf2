<?php

namespace Cma\CmaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Apropos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cma\CmaBundle\Repository\AproposRepository")
 */
class Apropos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description1", type="string", length=1024)
     */
    private $description1;

    /**
     * @var string
     *
     * @ORM\Column(name="description2", type="string", length=1024)
     */
    private $description2;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;

    /**
     * @Assert\File(maxSize="500k",
     * mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     * mimeTypesMessage = "Ce fichier doit être une image de type : jpg et jpeg, png")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="ImageLocation")
     *  
     */
    private $imageLocation;


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
     * Set title
     *
     * @param string $title
     * @return Apropos
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description1
     *
     * @param string $description1
     * @return Apropos
     */
    public function setDescription1($description1)
    {
        $this->description1 = $description1;

        return $this;
    }

    /**
     * Get description1
     *
     * @return string 
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * Set description2
     *
     * @param string $description2
     * @return Apropos
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;

        return $this;
    }

    /**
     * Get description2
     *
     * @return string 
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Apropos
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return Apropos
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set imageLocation
     *
     * @param string $imageLocation
     * @return MenuItem
     */
    public function setImageLocation($imageLocation)
    {
        $this->imageLocation = $imageLocation;

        return $this;
    }

    /**
     * Get imageLocation
     *
     * @return string 
     */
    public function getImageLocation()
    {
        return $this->imageLocation;
    }


    /**
     *  upload image location
     */
    
    public function getWebPath() {
        return null === $this->imageLocation ? null : $this->getUploadDir() . '/' . $this->imageLocation;
    }
 

    protected function getUploadRootDir() {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'bundles/cmadmin/images/Apropos';
    }

    public function uploadMenuPicture() {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique 
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité
        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->imageLocation = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
    }
    

}
