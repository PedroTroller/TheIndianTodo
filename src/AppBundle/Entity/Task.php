<?php

namespace AppBundle\Entity;

use AppBundle\Behavior\Timestampable;
use AppBundle\Entity\Collection\PersonCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task implements Timestampable
{
    use Behavior\Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank(groups="task_title")
     */
    private $title;

    /**
     * @ORM\Column(nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person", cascade="all")
     */
    private $owner;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person", cascade="all")
     */
    private $creator;

    /**
     * @ORM\ManyToMany(targetEntity="Person", cascade="persist", indexBy="email")
     */
    private $persons;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Memo", inversedBy="tasks")
     */
    private $memo;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    public function getPersons()
    {
        return new PersonCollection($this->persons);
    }

    public function setPersons($persons)
    {
        $this->persons = $persons;

        return $this;
    }

    public function getMemo()
    {
        return $this->memo;
    }

    public function setMemo($memo)
    {
        $collection = $memo->getTasks();
        if (false === $collection->contains($this)) {
            $collection->add($this);
        }

        $this->memo = $memo;

        return $this;
    }
}
