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
     * @ORM\OneToMany(targetEntity="MatchBundle\Entity\Versus", mappedBy="tournament", cascade={"persist", "remove"})
     */
    private $match;


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
        $this->match = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add match
     *
     * @param \MatchBundle\Entity\Versus $match
     *
     * @return Tournament
     */
    public function addMatch(\MatchBundle\Entity\Versus $match)
    {
        $match->setTournament($this);
        $this->match[] = $match;

        return $this;
    }

    /**
     * Remove match
     *
     * @param \MatchBundle\Entity\Versus $match
     */
    public function removeMatch(\MatchBundle\Entity\Versus $match)
    {
        $this->match->removeElement($match);
    }

    /**
     * Get match
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatch()
    {
        return $this->match;
    }
}
