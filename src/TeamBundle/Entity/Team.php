<?php

namespace TeamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Team
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TeamBundle\Entity\TeamRepository")
 * @ExclusionPolicy("all")
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="MatchBundle\Entity\Score", mappedBy="team", cascade={"persist", "remove"})
     * @Expose
     * @MaxDepth(1)
    */
    private $score;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Expose
     * @MaxDepth(1)
    */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="team")
     * @Expose
     * @MaxDepth(1)
    */
    private $users;
    
    /**
     * @ORM\OneToMany(targetEntity="MatchBundle\Entity\Versus", mappedBy="team1")
     * @MaxDepth(1)
    */
    private $versus;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
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
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Team
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
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
     * Add score
     *
     * @param \MatchBundle\Entity\Score $score
     *
     * @return Team
     */
    public function addScore(\MatchBundle\Entity\Score $score)
    {
        $this->score[] = $score;

        return $this;
    }

    /**
     * Remove score
     *
     * @param \MatchBundle\Entity\Score $score
     */
    public function removeScore(\MatchBundle\Entity\Score $score)
    {
        $this->score->removeElement($score);
    }

    /**
     * Get score
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Add versus
     *
     * @param \MatchBundle\Entity\Versus $versus
     *
     * @return Team
     */
    public function addVersus(\MatchBundle\Entity\Versus $versus)
    {
        $this->versus[] = $versus;

        return $this;
    }

    /**
     * Remove versus
     *
     * @param \MatchBundle\Entity\Versus $versus
     */
    public function removeVersus(\MatchBundle\Entity\Versus $versus)
    {
        $this->versus->removeElement($versus);
    }

    /**
     * Get versus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVersus()
    {
        return $this->versus;
    }

    /**
     * Set teacher
     *
     * @param \UserBundle\Entity\User $teacher
     *
     * @return Team
     */
    public function setTeacher(\UserBundle\Entity\User $teacher)
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
}
