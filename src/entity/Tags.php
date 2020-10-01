<?php

namespace src\entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\src\repository\TagsRepository")
 * @ORM\Table(name="tags")
 */
class Tags
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
     * @ORM\Column(type="string")
     */
    private $tagname;


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
     * @return Tags
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
     * Set tagName.
     *
     * @param string $tagname
     *
     * @return Tags
     */
    public function setTagName($tagname)
    {
        $this->tagname = $tagname;

        return $this;
    }

    /**
     * Get tagName.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagname;
    }
}
