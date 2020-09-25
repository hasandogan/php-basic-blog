<?php
namespace src\entity;

use Doctrine\ORM\Mapping as ORM;
use src\repository\CommentRepository;
/**
 * @ORM\Entity(repositoryClass="src\repository\CommentRepository")
 * @ORM\Table(name="comments")
 */
class Comments
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
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed = '0';

    /**
     * @ORM\Column(type="integer")
     */
    private $articleid;

    /**
     * @ORM\Column (type="datetime")
     */
    private $createdat;


    /**
     * @ORM\Column (type="string")
     */
    private $articletitle;


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
     * Set username.
     *
     * @param string $username
     *
     * @return Comments
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Comments
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
     * Set confirmed.
     *
     * @param bool|null $confirmed
     *
     * @return Comments
     */
    public function setConfirmed($confirmed = null)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed.
     *
     * @return bool|null
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set articleid.
     *
     * @param int|null $articleid
     *
     * @return Comments
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
     * Set createdat.
     *
     * @param \DateTime|null $createdat
     *
     * @return Comments
     */
    public function setcreatedAt($createdat = null)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat.
     *
     * @return \DateTime|null
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set articletitle.
     *
     * @param string|null $articletitle
     *
     * @return Comments
     */
    public function setArticletitle($articletitle = null)
    {
        $this->articletitle = $articletitle;

        return $this;
    }

    /**
     * Get articletitle.
     *
     * @return string|null
     */
    public function getArticletitle()
    {
        return $this->articletitle;
    }
}
