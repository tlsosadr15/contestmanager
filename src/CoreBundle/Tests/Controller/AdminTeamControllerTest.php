<?php
/**
 * AdminTeamControllerTest class file
 *
 * PHP Version 7
 *
 * @category Test
 * @package  CoreBundle\Tests\Controller
 * @author   @author Guillaume <contact@guillaume-torres.fr>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\Tests\Controller;

use CoreBundle\Tests\BaseTest;
use MatchBundle\Entity\GroupMatch;
use TeamBundle\Entity\Team;

/**
 * AdminTeamControllerTest class
 *
 * @category Test
 * @package  CoreBundle\Tests\Controller
 * @author   @author Guillaume <contact@guillaume-torres.fr>
 * @license  All right reserved
 * @link     Null
 */
class AdminTeamControllerTest extends BaseTest
{
    /**
     * Test team list
     *
     * @return null
     */
    public function testIndex()
    {
        $crawler = $this->client->request('GET', $this->getRouter()->generate('admin_team_team_list'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Admin', $crawler->filter('title')->text());
    }

    /**
     * Test team creation
     *
     * @return null
     */
    public function testTeamCreate()
    {
        $crawler = $this->client->request('GET', $this->getRouter()->generate('admin_team_team_create'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $action = $crawler->filter('div.sonata-ba-form form')->attr('action');
        $formId = explode('=', $action)[1];
        /** @var GroupMatch $group */
        $group = $this->fixtures->getReference('group1');

        $form = $crawler->selectButton('btn_create_and_edit')->form();
        $form->setValues(
            array(
                $formId => array(
                  'name' => 'lorem ipsum',
                  'group' => $group->getId(),
                ),
            )
        );
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "lorem ipsum" a été créé avec succès.', $crawler->filter('div.alert-success')->text());
    }

    /**
     * Test team edition
     *
     * @return null
     */
    public function testTeamEdit()
    {
        /** @var Team $team */
        $team = $this->fixtures->getReference('team1');

        $crawler = $this->client->request('GET', $this->getRouter()->generate(
            'admin_team_team_edit',
            ['id' => $team->getId()]
        ));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $action = $crawler->filter('div.sonata-ba-form form')->attr('action');
        $formId = explode('=', $action)[1];

        $form = $crawler->selectButton('btn_update_and_list')->form();
        $form->setValues(array($formId => array('name' => 'new team')));
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "new team" a été mis à jour avec succès.', $crawler->filter('div.alert-success')->text());
    }

    /**
     * Test team deletion
     *
     * @return null
     */
    public function testTeamDelete()
    {
        /** @var Team $team */
        $team = $this->fixtures->getReference('team1');

        $crawler = $this->client->request('GET', $this->getRouter()->generate(
            'admin_team_team_delete',
            ['id' => $team->getId()]
        ));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Êtes-vous sûr de vouloir supprimer l\'élément "'.$team->getName().'" sélectionné?', $crawler->filter('div.box-body')->text());

        $form = $crawler->filter('button:contains("supprimer")')->eq(0)->form();
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "'.$team->getName().'" a été supprimé avec succès.', $crawler->filter('div.alert-success')->text());
    }
}
