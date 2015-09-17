<?php

namespace AppBundle\Entity;

use AppBundle\Behavior\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Person implements Timestampable
{
    use Behavior\Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(nullable=true)
     */
    private $email;

    public function getId()
    {
        return $this->id;
    }

    public function getFullname()
    {
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
