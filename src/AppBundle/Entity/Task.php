<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Assignee
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Assignee")
     * @Assert\NotNull()
     */
    private $assignedTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dueDate", type="date")
     * @Assert\Date()
     */
    private $dueDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="blob", nullable=true)
     */
    private $description;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Project")
     * @Assert\NotNull()
     */
    private $projects;

    

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
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Task
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
     * Set assignedTo
     *
     * @param \AppBundle\Entity\Assignee $assignedTo
     *
     * @return Task
     */
    public function setAssignedTo(\AppBundle\Entity\Assignee $assignedTo = null)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return \AppBundle\Entity\Assignee
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Set projects
     *
     * @param \AppBundle\Entity\Project $projects
     *
     * @return Task
     */
    public function setProjects(\AppBundle\Entity\Project $projects = null)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * Get projects
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
