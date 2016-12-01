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
     * @ORM\Column(name="table_number", type="string", length=255)
     */
    private $tableNumber;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="finished", type="boolean")
     */
    private $finished;

    /**
     * @var string
     *
     * @ORM\Column(name="step", type="integer", nullable=false)
     */
    private $step = 1;

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
     * Set tableNumber
     *
     * @param string $tableNumber
     *
     * @return Versus
     */
    public function setTableNumber($tableNumber)
    {
        $this->tableNumber = $tableNumber;

        return $this;
    }

    /**
     * Get tableNumber
     *
     * @return string
     */
    public function getTableNumber()
    {
        return $this->tableNumber;
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
    public function isFinished()
    {
        return $this->finished;
    }

    /**
     * Set step
     *
     * @param integer $step
     *
     * @return Versus
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
    }
}
