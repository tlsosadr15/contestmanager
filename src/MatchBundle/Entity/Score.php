<?php

namespace MatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MatchBundle\Entity\ScoreRepository")
 */
class Score
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
     * @ORM\Column(name="score", type="integer")
     */
    private $score;
    
    /**
     * @ORM\ManyToOne(targetEntity="MatchBundle\Entity\Score", inversedBy="score", cascade={"persist", "remove"})
    */
    private $team;
    
    /**
     * @ORM\ManyToOne(targetEntity="MatchBundle\Entity\Score", inversedBy="score", cascade={"persist", "remove"})
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

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Score
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
     * Set team
     *
     * @param \MatchBundle\Entity\Score $team
     *
     * @return Score
     */
    public function setTeam(\MatchBundle\Entity\Score $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \MatchBundle\Entity\Score
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set versus
     *
     * @param \MatchBundle\Entity\Score $versus
     *
     * @return Score
     */
    public function setVersus(\MatchBundle\Entity\Score $versus = null)
    {
        $this->versus = $versus;

        return $this;
    }

    /**
     * Get versus
     *
     * @return \MatchBundle\Entity\Score
     */
    public function getVersus()
    {
        return $this->versus;
    }
}
