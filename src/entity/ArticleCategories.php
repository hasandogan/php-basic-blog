<?php

namespace src\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\src\repository\ArticleCategoriesRepository")
 * @ORM\Table(name="article_categories")
 */
class ArticleCategories
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $articleid;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoriesid;

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
     * Set articleid.
     *
     * @param int|null $articleid
     *
     * @return ArticleCategories
     */
    public function setArticleid($articleid = null)
    {
        $this->articleid = $articleid;

        return $this;
    }

    /**
     * Get articleid.
     *
     * @return int|null
     */
    public function getArticleid()
    {
        return $this->articleid;
    }

    /**
     * Set categoriesid.
     *
     * @param int|null $categoriesid
     *
     * @return ArticleCategories
     */
    public function setCategoriesid($categoriesid = null)
    {
        $this->categoriesid = $categoriesid;

        return $this;
    }

    /**
     * Get categoriesid.
     *
     * @return int|null
     */
    public function getCategoriesid()
    {
        return $this->categoriesid;
    }
}
