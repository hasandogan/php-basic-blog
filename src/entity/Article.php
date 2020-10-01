<?php

namespace src\entity;

use Doctrine\ORM\Mapping as ORM;
use src\repository\ArticleRepository;

/**
 * @ORM\Entity(repositoryClass="src\repository\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\Column (type="string")
     */
    private $title;

    /**
     * @ORM\Column (type="string")
     */
    private $author;

    /**
     * @ORM\Column (type="text")
     */
    private $content;

    /**
     * @ORM\Column (type="datetime", name="createdAt")
     */
    private $createdAt;

    /**
     * @ORM\Column (type="datetime")
     */
    private $updateat;

    /**
     * @ORM\Column (type="text")
     */
    private $imagePath;


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
     * Set slug.
     *
     * @param string|null $slug
     *
     * @return Article
     */
    public function setSlug($slug = null)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return Article
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author.
     *
     * @param string|null $author
     *
     * @return Article
     */
    public function setAuthor($author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Article
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdat.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Article
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateat.
     *
     * @param \DateTime|null $createdAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updateat = $updatedAt;

        return $this;
    }

    /**
     * Get updateat.
     *
     * @return \DateTime|null
     */
    public function getUpdateat()
    {
        return $this->updateat;
    }

    /**
     * Set imagePath.
     *
     * @param string $imagePath
     *
     * @return Article
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath.
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }


}
