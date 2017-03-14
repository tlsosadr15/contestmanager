<?php
/**
 * TournamentManager file
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  MatchBundle\Helper
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace MatchBundle\Helper;

use DateTime;
use MatchBundle\Entity\GroupMatch;
use MatchBundle\Entity\Score;
use MatchBundle\Entity\Tournament;
use MatchBundle\Entity\Versus;
use TeamBundle\Entity\Team;

/**
 * TournamentManager file
 *
 * @category Controller
 * @package  MatchBundle\Helper
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class TournamentManager
{
    /**
     * @param Tournament $tournament
     *
     * @return array
     */
    public static function getTournamentGroup($tournament)
    {
        $groups = [];
        $matchs = $tournament->getMatch();
        /** @var Versus $match */
        foreach ($matchs as $match) {
            /** @var Score $score */
            $score = $match->getScore()->first();
            $group = $score->getTeam()->getGroup();
            if (!array_key_exists($group->getId(), $groups)) {
                $groups[$group->getId()] = $group;
            }
        }

        return $groups;
    }

    /**
     * @param array   $groups
     * @param integer $nbMissingTeam
     *
     * @return array
     */
    public static function getBestTeams($groups, $nbMissingTeam)
    {
        $bestTeams = [];
        $totalTeams = [];
        $totalTeamsScore = [];
        /** @var GroupMatch $group */
        foreach ($groups as $group) {
            $bestTeam = $group->getTeam()->first();
            $teams = $group->getTeam();
            /** @var Team $team */
            foreach ($teams as $team) {
                $totalTeams[$team->getId()] = $team;
                $totalTeamsScore[$team->getId()] = $team->getBestScore();
                if ($team->getBestScore() > $bestTeam->getBestScore()) {
                    $bestTeam = $team;
                }
            }
            $bestTeams[] = $bestTeam;
            unset($totalTeamsScore[$bestTeam->getId()]);
        }

        if ($nbMissingTeam) {
            arsort($totalTeamsScore);
            $missingTeams = array_slice($totalTeamsScore, 0, $nbMissingTeam, true);
            foreach ($missingTeams as $key => $missingTeam) {
                $bestTeams[] = $totalTeams[$key];
            }
        }

        return $bestTeams;
    }

    /**
     * @param DateTime $day  Day
     * @param string   $time Time
     *
     * @return DateTime
     */
    public static function formatDate($day, $time)
    {
        $dayString = $day->format('Y-m-d');

        return new DateTime($dayString.' '.$time);
    }
}
