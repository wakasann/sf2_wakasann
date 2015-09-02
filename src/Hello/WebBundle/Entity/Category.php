<?php
namespace Hello\WebBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;


    /**
     * @ManyToOne(targetEntity="Author",inversedBy="categories")
     * @JoinColumn(name="author_id",referencedColumnName="id")
     */
    private $author;

    /**
     * @OneToMany(targetEntity="Category",mappedBy="parent")
     */
    private $children;

    /**
     * @ManyToOne(targetEntity="Category",inversedBy="children")
     * @JoinColumn(name="parent_id",referencedColumnName="id")
     */
    private $parent;

    /**
     * @ManyToMany(targetEntity="Book",mappedBy="categories")
     */
    private $books;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param \Hello\WebBundle\Entity\Author $author
     * @return Category
     */
    public function setAuthor(\Hello\WebBundle\Entity\Author $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \Hello\WebBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add children
     *
     * @param \Hello\WebBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\Hello\WebBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Hello\WebBundle\Entity\Category $children
     */
    public function removeChildren(\Hello\WebBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Hello\WebBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\Hello\WebBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Hello\WebBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add books
     *
     * @param \Hello\WebBundle\Entity\Book $books
     * @return Category
     */
    public function addBook(\Hello\WebBundle\Entity\Book $books)
    {
        $this->books[] = $books;
    
        return $this;
    }

    /**
     * Remove books
     *
     * @param \Hello\WebBundle\Entity\Book $books
     */
    public function removeBook(\Hello\WebBundle\Entity\Book $books)
    {
        $this->books->removeElement($books);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooks()
    {
        return $this->books;
    }
}