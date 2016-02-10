<?php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Versus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MatchBundle\Entity\VersusRepository")
 */
class Versus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_match", type="datetimetz")
     */
    private $dateMatch;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_table", type="string", length=255)
     */
    private $nbTable;
    
    /**
     * @ORM\ManyToOne(targetEntity="TeamBundle\Entity\Team", cascade={"persist", "remove"})
    */
    private $team1;
    
    /**
     * @ORM\ManyToOne(targetEntity="TeamBundle\Entity\Team", cascade={"persist", "remove"})
    */
    private $team2;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="finished", type="boolean")
     */
    private $finished;


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
     * Set dateMatch
     *
     * @param \DateTime $dateMatch
     *
     * @return Versus
     */
    public function setDateMatch($dateMatch)
    {
        $this->dateMatch = $dateMatch;

        return $this;
    }

    /**
     * Get dateMatch
     *
     * @return \DateTime
     */
    public function getDateMatch()
    {
        return $this->dateMatch;
    }

    /**
     * Set nbTable
     *
     * @param string $nbTable
     *
     * @return Versus
     */
    public function setNbTable($nbTable)
    {
        $this->nbTable = $nbTable;

        return $this;
    }

    /**
     * Get nbTable
     *
     * @return string
     */
    public function getNbTable()
    {
        return $this->nbTable;
    }

    /**
     * Set team1
     *
     * @param \TeamBundle\Entity\Team $team1
     *
     * @return Versus
     */
    public function setTeam1(\TeamBundle\Entity\Team $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return \TeamBundle\Entity\Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param \TeamBundle\Entity\Team $team2
     *
     * @return Versus
     */
    public function setTeam2(\TeamBundle\Entity\Team $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return \TeamBundle\Entity\Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set finished
     *
     * @param boolean $finished
     *
     * @return Versus
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }
}
