<?php

namespace Papillon\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ORM\Table(name="pp_users")
 * @ORM\Entity(repositoryClass="Papillon\UserBundle\Entity\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Username already exists")
 * @UniqueEntity(fields={"email"}, message="Email already exists")
 */
class User implements AdvancedUserInterface, \Serializable
{

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Papillon\TasksBundle\Entity\Tasks",mappedBy="User")
     * @Exclude
     */
    private $tasks;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=15, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=15)
     */
    private $username;


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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=60)
     * @Assert\Email()
     */
    private $email;


    /**
     * @var date $birth_date
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     * @Assert\Choice(choices = {"male", "female", null})
     */
    private $gender;


    /**
     * @ORM\Column(name="phone", type="string", length=55, nullable=true)
     */
    private $phone;


    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=150)
     */
    private $password;

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=40)
     */
    private $salt;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private $rawPassword;


    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    private $groups;


    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->active = true;
        $this->createdAt = new \DateTime();
    }

    public function encodePassword(PasswordEncoderInterface $encoder)
    {
        if ($this->rawPassword) {
            $this->salt = sha1(uniqid(mt_rand()));
            $this->password = $encoder->encodePassword(
                $this->rawPassword,
                $this->salt
            );
            $this->rawPassword = null;
        }
    }

    /**
     * Returns the roles granted to the user.
     *
     * @return Role[]|string[] The user roles
     */
    public function getRoles()
    {
        return $this->groups->toArray();
    }

    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }

    /**
     * @Assert\True(message="The password should not contain your username.")
     */
    public function isRawPasswordValid()
    {
        return false === strpos($this->rawPassword, $this->username);
    }

    public function setRawPassword($password)
    {
        $this->rawPassword = $password;
    }

    public function getRawPassword()
    {
        return $this->rawPassword;
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return ($this->first_name && $this->last_name) ? $this->first_name .' '. $this->last_name : null;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set active
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * Add groups
     *
     * @param \Papillon\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\Papillon\UserBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Papillon\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\Papillon\UserBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }


    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }


    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->active,
            $this->username
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->active,
            $this->username
            ) = unserialize($serialized);
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
     * Set birth_date
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birth_date
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birth_date;
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
     * @return User
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
