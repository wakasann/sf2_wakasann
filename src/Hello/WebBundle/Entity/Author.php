<?php
namespace Hello\WebBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="AuthorRepository")
 * @ORM\Table(name="author")
 */
class Author {

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
     * @ORM\Column(type="datetime")
     */
    protected $birth;

    /**
     * @OneToMany(targetEntity="Book",mappedBy="author")
     */
    private $books;

    /**
     * @OneToMany(targetEntity="Category",mappedBy="author")
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Author
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
     * Set birth
     *
     * @param \DateTime $birth
     * @return Author
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    
        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Add books
     *
     * @param \Hello\WebBundle\Entity\Book $books
     * @return Author
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

    /**
     * Add categories
     *
     * @param \Hello\WebBundle\Entity\Category $categories
     * @return Author
     */
    public function addCategorie(\Hello\WebBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Hello\WebBundle\Entity\Category $categories
     */
    public function removeCategorie(\Hello\WebBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}