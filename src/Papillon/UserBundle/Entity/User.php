<?php

namespace Papillon\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="pp_users")
 * @ORM\Entity(repositoryClass="Papillon\UserBundle\Entity\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Username already exists")
 * @UniqueEntity(fields={"email"}, message="Email already exists")
 */
class User implements UserInterface
{

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Papillon\TasksBundle\Entity\Tasks",mappedBy="User")
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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=60)
     * @Assert\Email()
     */
    private $email;

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
     * @var boolean $admin
     *
     * @ORM\Column(name="admin", type="boolean")
     */
    private $admin;

    /**
     * @var datetime $expiresAt
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=5)
     */
    private $rawPassword;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->active  = true;
        $this->admin   = false;
        $this->expiresAt = new \DateTime('+30 days');
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

    public function getRoles()
    {
        if ($this->admin) {
            return array('ROLE_ADMIN');
        }

        return array('ROLE_PLAYER');
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
     * Set admin
     *
     * @param boolean $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set expiresAt
     *
     * @param datetime $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get expiresAt
     *
     * @return datetime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
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
}
