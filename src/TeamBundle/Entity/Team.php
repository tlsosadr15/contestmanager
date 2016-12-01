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
     * @ORM\Column(name="score", type="integer", nullable=true)
     * @Expose
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="team")
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     * @MaxDepth(1)
    */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="SchoolBundle\Entity\Student", mappedBy="team")
     * @Expose
     * @MaxDepth(1)
    */
    private $student;

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
