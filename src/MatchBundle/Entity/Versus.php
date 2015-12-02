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
}

