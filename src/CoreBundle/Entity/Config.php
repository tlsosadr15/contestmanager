<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Config
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
     * @var integer
     *
     * @ORM\Column(name="tournament_lenght", type="integer")
     */
    private $tournamentLenght;


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
     * Set tournamentLenght
     *
     * @param integer $tournamentLenght
     *
     * @return Config
     */
    public function setTournamentLenght($tournamentLenght)
    {
        $this->tournamentLenght = $tournamentLenght;

        return $this;
    }

    /**
     * Get tournamentLenght
     *
     * @return integer
     */
    public function getTournamentLenght()
    {
        return $this->tournamentLenght;
    }
}

