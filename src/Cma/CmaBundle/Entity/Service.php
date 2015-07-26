<?php

namespace Cma\CmaBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Service {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")Upload ima
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="descripton", type="string", length=2048)
     */
    private $descripton;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $tag;
    
    /**
     * @Assert\File(maxSize="1024k")
     */
    public $file;
 
    

    public function __construct() {
     /* votre code ici */ 
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Service
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
    public function getTag()
    {
        return $this->tag;
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Service
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

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
     * Set descripton
     *
     * @param string $descripton
     * @return Service
     */
    public function setDescripton($descripton)
    {
        $this->descripton = $descripton;

        return $this;
    }

    /**
     * Get descripton
     *
     * @return string 
     */
    public function getDescripton()
    {
        return $this->descripton;
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
        return 'bundles/cmadmin/images/services';
    }
   
    public function uploadServcePicture()
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
}
