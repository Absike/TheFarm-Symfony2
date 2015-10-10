<?php

namespace Papillon\TasksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table("projects")
 * @ORM\Entity(repositoryClass="Papillon\TasksBundle\Entity\ProjectsRepository")
 */
class Projects
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
     *
     * @ORM\ManyToOne(targetEntity="Papillon\TasksBundle\Entity\Customers", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customers;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20 , nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_opening", type="date")
     */
    private $dateOpening;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_closing", type="date")
     */
    private $dateClosing;


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
     * @return Projects
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
     * Set description
     *
     * @param string $description
     * @return Projects
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
     * Set type
     *
     * @param string $type
     * @return Projects
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateOpening
     *
     * @param \DateTime $dateOpening
     * @return Projects
     */
    public function setDateOpening($dateOpening)
    {
        $this->dateOpening = $dateOpening;

        return $this;
    }

    /**
     * Get dateOpening
     *
     * @return \DateTime 
     */
    public function getDateOpening()
    {
        return $this->dateOpening;
    }

    /**
     * Set dateClosing
     *
     * @param \DateTime $dateClosing
     * @return Projects
     */
    public function setDateClosing($dateClosing)
    {
        $this->dateClosing = $dateClosing;

        return $this;
    }

    /**
     * Get dateClosing
     *
     * @return \DateTime 
     */
    public function getDateClosing()
    {
        return $this->dateClosing;
    }

    /**
     * Set customers
     *
     * @param \Papillon\TasksBundle\Entity\Customers $customers
     * @return Projects
     */
    public function setCustomers(\Papillon\TasksBundle\Entity\Customers $customers)
    {
        $this->customers = $customers;

        return $this;
    }

    /**
     * Get customers
     *
     * @return \Papillon\TasksBundle\Entity\Customers
     */
    public function getCustomers()
    {
        return $this->customers;
    }
}
