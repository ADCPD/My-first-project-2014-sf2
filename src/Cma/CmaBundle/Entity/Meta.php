<?php

namespace Cma\CmaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Meta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cma\CmaBundle\Repository\MetaRepository")
 */
class Meta {

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
     * @ORM\Column(name="slogon", type="string", length=1024 ,nullable=true)
     */
    private $slogon;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255 ,nullable=true)
     */
    private $title;

     
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024 ,nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255 ,nullable=true)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=1024 ,nullable=true)
     */
    private $keyword;

    /**
     * @var string
     *
     * @ORM\Column(name="script", type="string", length=1024 ,nullable=true)
     */
    private $script;

     /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set slogon
     *
     * @param string $slogon
     * @return Meta
     */
    public function setSlogon($slogon) {
        $this->slogon = $slogon;

        return $this;
    }

    /**
     * Get slogon
     *
     * @return string 
     */
    public function getSlogon() {
        return $this->slogon;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Meta
     */
    public function setTag($tag) {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Meta
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Meta
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return Meta
     */
    public function setKeyword($keyword) {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword() {
        return $this->keyword;
    }

    /**
     * Set script
     *
     * @param string $script
     * @return Meta
     */
    public function setScript($script) {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script
     *
     * @return string 
     */
    public function getScript() {
        return $this->script;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Meta
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

}
