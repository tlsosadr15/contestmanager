<?php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tournament
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="halfDay", type="string", length=255)
     */
    private $halfDay;

    /**
     * @ORM\OneToMany(targetEntity="MatchBundle\Entity\GroupMatch", mappedBy="tournament", cascade={"persist", "remove"})
     */
    private $group;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Tournament
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set halfDay
     *
     * @param string $halfDay
     *
     * @return Tournament
     */
    public function setHalfDay($halfDay)
    {
        $this->halfDay = $halfDay;

        return $this;
    }

    /**
     * Get halfDay
     *
     * @return string
     */
    public function getHalfDay()
    {
        return $this->halfDay;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add group
     *
     * @param \MatchBundle\Entity\GroupMatch $group
     *
     * @return Tournament
     */
    public function addGroup(\MatchBundle\Entity\GroupMatch $group)
    {
        $group->setTournament($this);
        $this->group[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \MatchBundle\Entity\GroupMatch $group
     */
    public function removeGroup(\MatchBundle\Entity\GroupMatch $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
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
}
