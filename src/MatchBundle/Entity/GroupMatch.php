<?php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

/**
 * GroupMatch
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GroupMatch
{
    /**
     * @var integer
     * 
     * @Serializer\MaxDepth(3)
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @Serializer\MaxDepth(1)
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Serializer\MaxDepth(1)
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="group")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", onDelete="set null", nullable=true)
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="TeamBundle\Entity\Team", mappedBy="group", orphanRemoval=true)
     * @Serializer\MaxDepth(1)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="MatchBundle\Entity\Tournament", inversedBy="group", cascade={"persist", "remove"})
     */
    private $tournament;

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return GroupMatch
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
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add team
     *
     * @param \TeamBundle\Entity\Team $team
     *
     * @return GroupMatch
     */
    public function addTeam(\TeamBundle\Entity\Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \TeamBundle\Entity\Team $team
     */
    public function removeTeam(\TeamBundle\Entity\Team $team)
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

    /**
     * Set teacher
     *
     * @param \UserBundle\Entity\User $teacher
     *
     * @return GroupMatch
     */
    public function setTeacher(\UserBundle\Entity\User $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \UserBundle\Entity\User
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set tournament
     *
     * @param \MatchBundle\Entity\Tournament $tournament
     *
     * @return GroupMatch
     */
    public function setTournament(\MatchBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \MatchBundle\Entity\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }


    public function __unset($key)
    {
        unset($this->$key);
    }
}
