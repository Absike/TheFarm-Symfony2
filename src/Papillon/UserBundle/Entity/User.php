<?php

namespace Papillon\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;


/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Papillon\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(min = "3", max="60");
     * @Assert\Type(type="string")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(min = "3", max="60");
     * @Assert\Type(type="string")
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('male', 'femelle')" , nullable=true )
     * @Assert\Choice(choices = {"male", "female", null})
     */
    private $gender;


    /**
     * @ORM\Column(name="phone", type="string", length=55, nullable=true)
     */
    private $phone;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Papillon\TasksBundle\Entity\Tasks",mappedBy="User")
     * @Exclude
     */
    private $tasks;


    public function __construct()
    {
        parent::__construct();
        $this->tasks = new ArrayCollection();
    }


    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return ($this->first_name && $this->last_name) ? $this->first_name . ' ' . $this->last_name : null;
    }


    function __toString()
    {
        return ($this->getFullname()) ? $this->getFullname() : $this->getUsername();
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Add tasks
     *
     * @param \Papillon\TasksBundle\Entity\Tasks $tasks
     * @return User
     */
    public function addTask(\Papillon\TasksBundle\Entity\Tasks $tasks)
    {
        $this->tasks[] = $tasks;

        return $this;
    }

    /**
     * Remove tasks
     *
     * @param \Papillon\TasksBundle\Entity\Tasks $tasks
     */
    public function removeTask(\Papillon\TasksBundle\Entity\Tasks $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return string
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
