<?php

namespace Cma\CmaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
 use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Certificat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cma\CmaBundle\Repository\CertificatRepository")
 */
class Certificat
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
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024,nullable=true)
     */
    private $description;

    
    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255,nullable=true)
     */
    private $tag;

    /**
     * @Assert\File(maxSize="500k",
     * mimeTypes = {"image/jpeg", "image/png", "image/jpg"},
     * mimeTypesMessage = "Ce fichier doit être une image de type : jpg et jpeg, png")
     * @ORM\Column(nullable=true)
     */
    public $file;

    
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
     * @return Slide
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
     * Set tag
     *
     * @param string $tag
     * @return Slide
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
     *  Upload File // Image //
     */
     
    public function getWebPath()
    {
        return null === $this->tag ? null : $this->getUploadDir().'/'.$this->tag;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'bundles/cmadmin/images/services/certificat/';
    }
   
    public function uploadCertificatPicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->tag = $this->file->getClientOriginalName();
       
        // La propriété file ne servira plus
        $this->file = null;
    } 

    /**
     * Set description
     *
     * @param string $description
     * @return Certificat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
