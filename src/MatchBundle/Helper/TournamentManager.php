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

use MatchBundle\Entity\Score;
use MatchBundle\Entity\Tournament;
use MatchBundle\Entity\Versus;

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
}
