<?php

namespace src\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="src\repository\CategoriesRepository")
 * @ORM\Table(name="categories")
 */
class Categories
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $pageTitle;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    private $metaDesc;

    /**
     * @ORM\Column(type="string")
     */
    private $metaKey;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pageTitle.
     *
     * @param string $pageTitle
     *
     * @return Categories
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle.
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Categories
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
     * Set metaDesc.
     *
     * @param string|null $metaDesc
     *
     * @return Categories
     */
    public function setMetaDesc($metaDesc = null)
    {
        $this->metaDesc = $metaDesc;

        return $this;
    }

    /**
     * Get metaDesc.
     *
     * @return string|null
     */
    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    /**
     * Set metaKey.
     *
     * @param string|null $metaKey
     *
     * @return Categories
     */
    public function setMetaKey($metaKey = null)
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    /**
     * Get metaKey.
     *
     * @return string|null
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }
}
