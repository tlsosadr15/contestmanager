<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     * @Expose
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     * @Expose
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     * @Expose
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="TeamBundle\Entity\Team", inversedBy="user", cascade={"persist", "remove"})
     * @Expose
     * @MaxDepth(1)
    */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="SchoolBundle\Entity\School", inversedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * @Expose
     * @MaxDepth(1)
    */
    private $school;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
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
     * Set team
     *
     * @param \TeamBundle\Entity\Team $team
     *
     * @return User
     */
    public function setTeam(\TeamBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \TeamBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set school
     *
     * @param \SchoolBundle\Entity\School $school
     *
     * @return User
     */
    public function setSchool(\SchoolBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \SchoolBundle\Entity\School
     */
    public function getSchool()
    {
        return $this->school;
    }
}
