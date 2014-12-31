<?php

namespace Papillon\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Group
 *
 * @ORM\Table(name="pp_roles")
 * @ORM\Entity(repositoryClass="Papillon\UserBundle\Entity\GroupRepository")
 */
class Group implements RoleInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(name="name", type="string", length=30) */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=30, unique=true)
     */
    private $role;


    /** @ORM\ManyToMany(targetEntity="User", mappedBy="groups") */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set role
     *
     * @param string $role
     * @return Group
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /** @see RoleInterface */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Group
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
     * Add users
     *
     * @param \Papillon\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Papillon\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Papillon\UserBundle\Entity\User $users
     */
    public function removeUser(\Papillon\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }


    /**
     * @see \Serializable::serialize()
     */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->name,
            $this->role
        ));
    }


    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->name,
            $this->role
            ) = unserialize($serialized);
    }


    function __toString()
    {
        return $this->getName();
    }
}
