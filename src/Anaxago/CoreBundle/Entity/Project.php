<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imageURL", type="text")
     */
    private $imageURL;


    /**
     * @var float
     *
     * @ORM\Column(name="callForFund", type="float")
     */
    private $callForFund;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFunded", type="boolean")
     */
    private $isFunded;





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
     * Set slug
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
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
     * Set description
     *
     * @param string $description
     *
     * @return Project
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

    /**
     * Set imageURL
     *
     * @param string $imageURL
     *
     * @return Project
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;

        return $this;
    }

    /**
     * Get imageURL
     *
     * @return string
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }


    /**
     * Set callForFund
     *
     * @param float $callForFund
     *
     * @return Project
     */
    public function setCallForFund($callForFund)
    {
        $this->callForFund = $callForFund;

        return $this;
    }

    /**
     * Get callForFund
     *
     * @return float
     */
    public function getCallForFund()
    {
        return $this->callForFund;
    }

    /**
     * Set isFunded
     * @param float $isFunded
     *
     * @return Project
     */
    public function setIsFunded($isFunded)
    {
        $this->isFunded = $isFunded;

        return $this;
    }

    /**
     * Get isFunded
     *
     * @return boolean
     */
    public function getIsFunded()
    {
        return $this->isFunded;
    }


}

