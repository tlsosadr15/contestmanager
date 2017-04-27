<?php
/**
 * LoadTeamData class file
 *
 * PHP Version 7.0
 *
 * @category Fixture
 * @package  CoreBundle\DataFixtures\ORM
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SchoolBundle\Entity\Student;
use TeamBundle\Entity\Team;

/**
 * Class LoadTeamData
 *
 * @category Fixture
 * @package  CoreBundle\DataFixtures\ORM
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class LoadTeamData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param ObjectManager $manager Object manager
     *
     * @return null
     */
    public function load(ObjectManager $manager)
    {
        $lorem = 'Lorem ipsum dolor amet consectetur adipiscing elit sed eiusmod tempor incididunt labore dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat';
        $nameList = explode(' ', $lorem);

        $groupCpt = 1;
        for ($i = 1; $i <= 12; $i++) {
            $team = new Team();
            $teamName = $nameList[array_rand($nameList)];
            $team->setName($teamName);
            $team->setGroup($this->getReference('group'.$groupCpt));

            $manager->persist($team);
            $this->addReference('team'.$i, $team);

            if ($i%3 == 0) {
                $groupCpt++;
            }
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}
