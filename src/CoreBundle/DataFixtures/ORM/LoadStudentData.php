<?php
/**
 * LoadStudentData class file
 *
 * PHP Version 7.0
 *
 * @category Fixture
 * @package  CoreBundle\DataFixtures\ORM
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SchoolBundle\Entity\Student;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

/**
 * Class LoadStudentData
 *
 * @category Fixture
 * @package  CoreBundle\DataFixtures\ORM
 * @author   Guillaume <guillaume.torres91@gmail.com>
 * @license  All right reserved
 * @link     Null
 */
class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface
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
        $lorem = 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat';
        $nameList = explode(' ', $lorem);

        for ($i = 0; $i < 17; $i++) {
            $student = new Student();
            $lastName = $nameList[array_rand($nameList)];
            $firstName = $nameList[array_rand($nameList)];
            $student->setFirstName($firstName);
            $student->setLastName($lastName);

            $manager->persist($student);
            $this->addReference('student'.$i, $student);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
