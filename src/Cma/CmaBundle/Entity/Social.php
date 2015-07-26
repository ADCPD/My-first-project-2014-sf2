<?php

namespace Cma\CmaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Social
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cma\CmaBundle\Repository\SocialRepository")
 */
class Social
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
     * @ORM\Column(name="Reseau", type="string", length=255)
     */
    private $reseau;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=500)
     */
    private $url;


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
     * Set reseau
     *
     * @param string $reseau
     * @return Social
     */
    public function setReseau($reseau)
    {
        $this->reseau = $reseau;

        return $this;
    }

    /**
     * Get reseau
     *
     * @return string 
     */
    public function getReseau()
    {
        return $this->reseau;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Social
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
