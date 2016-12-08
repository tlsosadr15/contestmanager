<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use TeamBundle\Entity\Team;

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
     * @ORM\ManyToOne(targetEntity="SchoolBundle\Entity\School", inversedBy="teacher", cascade={"persist"})
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     * @Expose
     * @MaxDepth(1)
    */
    private $school;

    /**
     * @ORM\OneToMany(targetEntity="TeamBundle\Entity\Team", mappedBy="teacher", orphanRemoval=true)
     * @ORM\Column(nullable=true)
     */
    private $team;

    public function __construct()
    {
        parent::__construct();
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add team
     *
     * @param Team $team
     *
     * @return User
     */
    public function addTeam(Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param Team $team
     */
    public function removeTeam(Team $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }
}
