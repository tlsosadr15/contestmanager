<?php

namespace SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * School
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SchoolBundle\Entity\SchoolRepository")
 * @ExclusionPolicy("all")
 */
class School
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
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
     * @ORM\OneToMany(targetEntity="SchoolBundle\Entity\Student", mappedBy="school", orphanRemoval=true)
     */
    private $student;
    
    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="school", orphanRemoval=true, cascade={"persist"})
    */
    private $teacher;
    
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->student = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teacher = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return School
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
     * Add student
     *
     * @param \SchoolBundle\Entity\Student $student
     *
     * @return School
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
     * Add teacher
     *
     * @param \UserBundle\Entity\User $teacher
     *
     * @return School
     */
    public function addTeacher(\UserBundle\Entity\User $teacher)
    {
        $this->teacher[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \UserBundle\Entity\User $teacher
     */
    public function removeTeacher(\UserBundle\Entity\User $teacher)
    {
        $this->teacher->removeElement($teacher);
    }

    /**
     * Get teacher
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set student
     *
     * @param string $student
     *
     * @return School
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Set teacher
     *
     * @param string $teacher
     *
     * @return School
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }
}
