<?php

namespace Papillon\TasksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="Papillon\TasksBundle\Entity\TasksRepository")
 */
class Tasks
{


    /**
     * @var Author $author
     *
     * @ORM\ManyToOne(targetEntity="Papillon\UserBundle\Entity\User",inversedBy="tasks",cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(name="author_id",referencedColumnName="id")
     */
    private $author;

    /**
     * @var AssignedBy
     *
     * @ORM\ManyToOne(targetEntity="Papillon\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="assigned_by",referencedColumnName="id")
     */
    private $assignedBy;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $priority
     * @ORM\Column(name="priority", type="string", length=30)
     */
    private $priority;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=30)
     */
    private $status;

    /**
     * @var string $subject
     *
     * @ORM\Column(name="subject", type="string", length=200, nullable=true)
     */
    private $subject;

    /**
     * @var integer $time_spent
     * @ORM\Column(name="time_spent", type="integer", nullable=true)
     */
    private $time_spent;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var datetime $created_at
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;



    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->setTimeSpent(0);
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
     * Set priority
     *
     * @param string $priority
     * @return Tasks
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Tasks
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set time_spent
     *
     * @param integer $timeSpent
     * @return Tasks
     */
    public function setTimeSpent($timeSpent)
    {
        $this->time_spent = $timeSpent;

        return $this;
    }

    /**
     * Get time_spent
     *
     * @return integer 
     */
    public function getTimeSpent()
    {
        return $this->time_spent;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tasks
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Tasks
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Tasks
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if (!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * Set author
     *
     * @param \Papillon\UserBundle\Entity\User $author
     * @return Tasks
     */
    public function setAuthor(\Papillon\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Papillon\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set assignedBy
     *
     * @param \Papillon\UserBundle\Entity\User $assignedBy
     * @return Tasks
     */
    public function setAssignedBy(\Papillon\UserBundle\Entity\User $assignedBy = null)
    {
        $this->assignedBy = $assignedBy;

        return $this;
    }

    /**
     * Get assignedBy
     *
     * @return \Papillon\UserBundle\Entity\User 
     */
    public function getAssignedBy()
    {
        return $this->assignedBy;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Tasks
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
