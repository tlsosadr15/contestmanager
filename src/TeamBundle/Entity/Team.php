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
     * @var integer
     *
     * @ORM\Column(name="best_score", type="integer", nullable=true)
     * @Expose
     */
    private $bestScore;

    /**
     * @ORM\OneToMany(targetEntity="MatchBundle\Entity\Score", mappedBy="team", cascade={"persist", "remove"})
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="MatchBundle\Entity\GroupMatch", inversedBy="team")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="set null", nullable=true)
     * @Expose
     * @MaxDepth(1)
     */
    private $group;

    /**
     * @ORM\OneToMany(targetEntity="SchoolBundle\Entity\Student", mappedBy="team", orphanRemoval=true)
     * @Expose
     * @MaxDepth(1)
    */
    protected $student;

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
     * @return string
     */
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
        $this->student = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Team
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Add student
     *
     * @param \SchoolBundle\Entity\Student $student
     *
     * @return Team
     */
    public function addStudent(\SchoolBundle\Entity\Student $student)
    {
        $this->student[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \SchoolBundle\Entity\Student $student
     */
    public function removeStudent(\SchoolBundle\Entity\Student $student)
    {
        $this->student->removeElement($student);
    }

    /**
     * Get student
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set group
     *
     * @param \MatchBundle\Entity\GroupMatch $group
     *
     * @return Team
     */
    public function setGroup(\MatchBundle\Entity\GroupMatch $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \MatchBundle\Entity\GroupMatch
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set bestScore
     *
     * @param integer $bestScore
     *
     * @return Team
     */
    public function setBestScore($bestScore)
    {
        $this->bestScore = $bestScore;

        return $this;
    }

    /**
     * Get bestScore
     *
     * @return integer
     */
    public function getBestScore()
    {
        return $this->bestScore;
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
}
